<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Encuesta;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function whatsapp(Request $request)
    {
        // 📲 número que responde
        $numero = str_replace(['whatsapp:+521', 'whatsapp:+52'], '', $request->From);

        // 📝 mensaje recibido
        $mensaje = trim($request->Body);

        // 👤 buscar cliente
        $cliente = Cliente::where('telefono', $numero)->first();

        if (!$cliente) {
            return response('ok', 200);
        }

        // ⭐ validar respuesta
        if (!in_array($mensaje, ['1','2','3','4','5'])) {
            return response('ok', 200);
        }

        // 🔥 obtener último movimiento
        $movimiento = \App\Models\MovimientoPunto::where('cliente_id', $cliente->id)
            ->latest()
            ->first();

        // 💾 guardar encuesta
        Encuesta::create([
            'cliente_id' => $cliente->id,
            'movimiento_id' => $movimiento?->id,
            'sucursal_id' => $movimiento?->sucursal_id,
            'calificacion' => $mensaje,
        ]);

        // 📲 RESPUESTA AUTOMÁTICA
        try {
            $twilio = new \App\Services\TwilioService();

            $respuesta = "💖 ¡Gracias por tu calificación!\n\n"
                . "Nos ayudas a mejorar cada día 🧁";

            $twilio->enviarWhatsApp($cliente->telefono, $respuesta);

        } catch (\Exception $e) {
             Log::error('Error respuesta encuesta: ' . $e->getMessage());
        }

        return response('ok', 200);
    }
}