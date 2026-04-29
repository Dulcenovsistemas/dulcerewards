<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoPunto;
use App\Models\Cliente;
use App\Models\Sucursal;
use App\Models\Premio;

use App\Services\TwilioService;

class MovimientoPuntoController extends Controller
{

    public function index()
    {
        $movimientos = MovimientoPunto::with(['cliente', 'sucursal'])
            ->latest()
            ->limit(50)
            ->get();

        // 🔥 Obtener puntos mínimos para canjear
        $minPuntos = Premio::where('activo', 1)->min('puntos_requeridos');

        // ⚠️ fallback por si no hay premios
        if (!$minPuntos) {
            $minPuntos = 999999; // nadie puede canjear
        }

        $clientes = Cliente::with('sucursal')->get()->map(function ($cliente) use ($minPuntos) {

            $puntos = MovimientoPunto::where('cliente_id', $cliente->id)->sum('puntos');

            return [
                'id' => $cliente->id,
                'nombre' => $cliente->nombre,
                'telefono' => $cliente->telefono,
                'ciudad' => optional($cliente->sucursal)->ciudad,
                'puntos' => $puntos,
                'puede_canjear' => $puntos >= $minPuntos,
            ];
        });

        $sucursales = Sucursal::all();

        return view('movimientos.index', compact('movimientos', 'clientes', 'sucursales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'telefono' => 'required',
            'cantidad' => 'required|integer|min:1',
        ]);

        $cliente = Cliente::where('telefono', $request->telefono)->first();

        if (!$cliente) {
            return back()->with('error', 'Cliente no encontrado');
        }

        $puntos = $request->cantidad;
        $user = auth()->user();

        // 🔥 LÓGICA CLAVE
        $sucursalId = $user->sucursal_id;

        if ($user->is_admin) {
            $request->validate([
                'sucursal_id' => 'required|exists:sucursales,id',
            ]);

            $sucursalId = $request->sucursal_id;
        }

        $sucursal = Sucursal::find($sucursalId);

        if (!$sucursal) {
            return back()->with('error', 'Sucursal no válida');
        }

        // 🔒 VALIDACIÓN DE CIUDAD
        if ($cliente->sucursal->ciudad !== $sucursal->ciudad) {
            return back()->with('error', 'Este cliente pertenece a otra ciudad');
        }

        // 🚀 GUARDAR MOVIMIENTO
        MovimientoPunto::create([
            'cliente_id' => $cliente->id,
            'sucursal_id' => $sucursalId,
            'usuario_id' => $user->id,
            'ciudad' => $sucursal->ciudad,
            'puntos' => $puntos,
            'tipo' => 'acumulado',
            'descripcion' => 'Compra de '.$puntos.' pasteles',
        ]);

        // 📲 WHATSAPP AUTOMÁTICO
      try {

            // 🔢 puntos totales
            $puntosTotales = MovimientoPunto::where('cliente_id', $cliente->id)->sum('puntos');

            // 🎁 premio disponible
            $premio = Premio::where('activo', 1)
                ->where('puntos_requeridos', '<=', $puntosTotales)
                ->orderByDesc('puntos_requeridos')
                ->first();

            // 📝 mensaje principal
            if ($premio) {
                $mensaje = "🎂 Dulce Noviembre\n\n"
                    . "⭐ Has acumulado {$puntos} puntos\n"
                    . "🔢 Total: {$puntosTotales} puntos\n\n"
                    . "🎁 ¡Ya tienes una recompensa disponible!\n"
                    . "👉 {$premio->nombre}\n\n"
                    . "¡Canjéala en tu próxima compra! 💖";
            } else {
                $mensaje = "🎂 Dulce Noviembre\n\n"
                    . "⭐ Has acumulado {$puntos} puntos\n"
                    . "🔢 Total: {$puntosTotales} puntos\n\n"
                    . "Sigue comprando para obtener recompensas 🎁";
            }

            // 🔥 SOLO si Twilio está activo + cliente acepta
            if (env('TWILIO_ENABLED') && $cliente->recibe_notificaciones == 1) {

                $twilio = new \App\Services\TwilioService();

                // 📩 1. Mensaje de puntos
                $twilio->enviarWhatsApp($cliente->telefono, $mensaje);

                // ⭐ 2. Encuesta
                $encuesta = "📝 ¿Cómo calificarías tu experiencia?\n\n"
                    . "Responde con un número:\n\n"
                    . "1️⃣ Excelente\n"
                    . "2️⃣ Bueno\n"
                    . "3️⃣ Regular\n"
                    . "4️⃣ Malo\n"
                    . "5️⃣ Muy malo";

                $twilio->enviarWhatsApp($cliente->telefono, $encuesta);
            }

        } catch (\Exception $e) {
            \Log::error('Error Twilio: ' . $e->getMessage());
        }
        return back()->with('success', 'Puntos agregados correctamente 🎉');
    }

    public function canjear(Request $request)
    {
        try {

            $cliente = Cliente::findOrFail($request->input('cliente_id'));

            $puntos = MovimientoPunto::where('cliente_id', $cliente->id)->sum('puntos');

            $premio = Premio::where('activo', 1)
                ->where('puntos_requeridos', '<=', $puntos)
                ->orderByDesc('puntos_requeridos')
                ->first();

            if (!$premio) {
                return $this->response($request, false, 'No tiene suficientes puntos');
            }

            $costo = $premio->puntos_requeridos;

            $user = auth()->user();

            $sucursalId = $request->input('sucursal_id');
            $sucursal = Sucursal::find($sucursalId);

            if (!$sucursal) {
                return $this->response($request, false, 'Sucursal no válida');
            }

            if ($cliente->sucursal->ciudad !== $sucursal->ciudad) {
                return $this->response($request, false, 'No puedes canjear en otra ciudad');
            }

            // 🚀 GUARDAR CANJE
            MovimientoPunto::create([
                'cliente_id' => $cliente->id,
                'sucursal_id' => $sucursalId,
                'usuario_id' => $user ? $user->id : 1,
                'ciudad' => $sucursal->ciudad,
                'puntos' => -$costo,
                'tipo' => 'canjeado',
                'descripcion' => 'Canje: ' . $premio->nombre,
            ]);

            // 📲 WHATSAPP
            try {
                if (env('TWILIO_ENABLED') && $cliente->recibe_notificaciones == 1) {
                    $twilio = new \App\Services\TwilioService();

                    $twilio->enviarWhatsApp(
                        $cliente->telefono,
                        "🎂 Dulce Noviembre\n\n🎉 Canje realizado\nPremio: {$premio->nombre}\n\n¡Gracias por tu preferencia! 💖"
                    );
                }
            } catch (\Exception $e) {
                \Log::error('Error Twilio: ' . $e->getMessage());
            }

            return $this->response($request, true, 'Canje realizado: ' . $premio->nombre . ' 🎉');

        } catch (\Exception $e) {
            return $this->response($request, false, 'Error al realizar el canje');
        }
    }

    private function response($request, $success, $message)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => $success,
                'message' => $message
            ]);
        }

        return $success
            ? back()->with('success', $message)
            : back()->with('error', $message);
    }

    public function crearDesdeQR($token)
    {
        $cliente = Cliente::where('token', $token)->first();

        if (!$cliente) {
            return back()->with('error', 'Cliente no encontrado');
        }

        return view('movimientos.crear', compact('cliente'));
    }


    public function testTwilio()
    {
        try {
            $twilio = new TwilioService();

            $twilio->enviarWhatsApp(
                '6251455586',
                '🚀 Prueba Twilio funcionando'
            );

            return 'Mensaje enviado';

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function validarCliente($token)
    {
        $cliente = Cliente::where('token', $token)->first();

        return response()->json($cliente);
    }

}