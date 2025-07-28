<?php

namespace App\Listeners;

use App\Events\ParticipanteRegistrado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
class EnviarCorreoBienvenida implements ShouldQueue
{

    public $queue = 'bienvenida_email';
    public function __construct()
    {
      
    }

    public function handle(ParticipanteRegistrado $event)
    {
        Log::info("Simulando envío de correo a: " . $event->participante->email);
    }
}
