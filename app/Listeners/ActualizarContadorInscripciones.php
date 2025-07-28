<?php

namespace App\Listeners;

use App\Events\ParticipanteRegistrado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;

class ActualizarContadorInscripciones 
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ParticipanteRegistrado $event): void
    {
        //
         Redis::incr('contador_inscripciones');
    }
}
