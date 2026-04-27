<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sucursal;
use App\Models\MovimientoPunto;
use App\Models\Premio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\TwilioService;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->rol === 'admin') {
            $sucursales = Sucursal::all();
        } else {
            $sucursales = Sucursal::where('id', $user->sucursal_id)->get();
        }

        return view('clientes.create', compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        // ✅ VALIDACIÓN
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|unique:clientes,telefono',
            'fecha_nacimiento' => 'nullable|date',
            'tipo_cliente' => 'required|in:propio,empresa',
            'empresa_nombre' => 'nullable|string|max:255',
            'sucursal_registro_id' => 'required|exists:sucursales,id',
        ]);

        // 🔍 NORMALIZAR TELÉFONO (opcional pero recomendado)
        $telefono = preg_replace('/\D/', '', $request->telefono);

        // 🔁 EVITAR DUPLICADOS
        $clienteExistente = Cliente::where('telefono', $telefono)->first();

        if ($clienteExistente) {
            return redirect('/cliente/'.$clienteExistente->qr_token)
                ->with('success', 'Cliente ya registrado 👀');
        }

        // 🧠 LIMPIAR EMPRESA SI NO APLICA
        $empresaNombre = $request->tipo_cliente === 'empresa'
            ? $request->empresa_nombre
            : null;

        // 💾 CREAR CLIENTE
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'tipo_cliente' => $request->tipo_cliente,
            'empresa_nombre' => $request->empresa_nombre,
            'recibe_notificaciones' => $request->has('recibe_notificaciones'),
            'sucursal_registro_id' => $request->sucursal_registro_id,
        ]);

        // 📲 WHATSAPP BIENVENIDA
        try {
            $twilio = new \App\Services\TwilioService();

            $mensaje = "🎂 Dulce Noviembre\n\n"
                . "¡Hola {$cliente->nombre}! 👋\n\n"
                . "🎉 Bienvenido a nuestro programa de fidelidad\n\n"
                . "⭐ Acumula puntos en cada compra\n"
                . "🎁 Canjéalos por recompensas deliciosas\n\n"
                . "¡Te esperamos pronto! 💖";
                
                if (env('TWILIO_ENABLED') && $cliente->recibe_notificaciones) {
                    $twilio->enviarWhatsApp($cliente->telefono, $mensaje);
                }

        } catch (\Exception $e) {
            // opcional: log
        }
        // 🎫 REDIRIGIR A TARJETA
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado correctamente 🎉');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::with('sucursal')->findOrFail($id);

        $puntos = MovimientoPunto::where('cliente_id', $id)->sum('puntos');

        // TODOS los premios (para mostrarlos en la vista)
        $premios = Premio::where('activo', 1)
            ->orderBy('puntos_requeridos')
            ->get();

        // SOLO el premio que le toca (exacto)
        $premioActual = $premios->firstWhere('puntos_requeridos', $puntos);

        $movimientos = MovimientoPunto::where('cliente_id', $id)
            ->latest()
            ->get();

        $canjes = MovimientoPunto::where('cliente_id', $id)
            ->where('tipo', 'canje')
            ->latest()
            ->get();

        return view('clientes.show', compact(
            'cliente',
            'puntos',
            'premios',
            'premioActual',
            'movimientos',
            'canjes'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $sucursales = Sucursal::all();

        return view('clientes.edit', compact('cliente', 'sucursales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'tipo_cliente' => 'required|in:propio,empresa',
            'empresa_nombre' => 'nullable|string|max:255',
        ]);

        // Normalizar teléfono
        $telefono = preg_replace('/\D/', '', $request->telefono);

        // Evitar duplicados (excepto el actual)
        $clienteExistente = Cliente::where('telefono', $telefono)
            ->where('id', '!=', $cliente->id)
            ->first();

        if ($clienteExistente) {
            return back()->withErrors([
                'telefono' => 'Este teléfono ya está registrado 👀'
            ])->withInput();
        }

        // Limpiar empresa si no aplica
        $empresaNombre = $request->tipo_cliente === 'empresa'
            ? $request->empresa_nombre
            : null;

        // Actualizar
        $cliente->update([
            'nombre' => $request->nombre,
            'telefono' => $telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'tipo_cliente' => $request->tipo_cliente,
            'empresa_nombre' => $empresaNombre,
            'recibe_notificaciones' => $request->has('recibe_notificaciones'),
            'sucursal_registro_id' => $request->sucursal_registro_id,
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente ✨');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente 🗑️');
    }
    
}
