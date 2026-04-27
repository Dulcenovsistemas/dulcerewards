<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cliente;
use App\Services\TwilioService;
use Carbon\Carbon;

class EnviarCumpleanios extends Command
{
    protected $signature = 'clientes:cumpleanios';
    protected $description = 'Enviar mensajes de cumpleaños a clientes';

    public function handle()
    {
        $hoy = Carbon::now();

        $clientes = Cliente::whereMonth('fecha_nacimiento', $hoy->month)
            ->whereDay('fecha_nacimiento', $hoy->day)
            ->get();

        foreach ($clientes as $cliente) {

            // 🔒 RESPETAR PREFERENCIA
            if (!$cliente->recibe_notificaciones) {
                continue;
            }

            try {
                $twilio = new TwilioService();

                $mensaje = "🎂 Dulce Noviembre\n\n"
                    . "🎉 ¡Feliz cumpleaños {$cliente->nombre}! 🎉\n\n"
                    . "Queremos consentirte en tu día especial 💖\n\n"
                    . "🎁 Pasa por tu sorpresa en sucursal\n\n"
                    . "¡Te esperamos! 🧁";

                $twilio->enviarWhatsApp($cliente->telefono, $mensaje);

                $this->info("Mensaje enviado a {$cliente->nombre}");

            } catch (\Exception $e) {
                $this->error("Error con {$cliente->nombre}");
            }
        }

        return 0;
    }
}