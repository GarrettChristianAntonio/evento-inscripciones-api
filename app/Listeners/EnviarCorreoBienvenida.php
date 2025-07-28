<?php

namespace App\Listeners;

use App\Events\ParticipanteRegistrado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class EnviarCorreoBienvenida implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public $queue = 'bienvenida_email';
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ParticipanteRegistrado $event)
    {
        Log::info("Simulando envío de correo a: " . $event->participante->email);
        // Simulación: solo logueamos por ahora
    }
}
