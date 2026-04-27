<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            env('TWILIO_SID'),
            env('TWILIO_TOKEN')
        );
    }

    public function enviarWhatsApp($numero, $mensaje)
    {
        return $this->client->messages->create(
            "whatsapp:+521" . $numero,
            [
                "from" => env('TWILIO_FROM'),
                "body" => $mensaje
            ]
        );
    }
}