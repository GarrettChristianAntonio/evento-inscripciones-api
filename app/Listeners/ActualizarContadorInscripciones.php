<?php
namespace App\Listeners;

use App\Events\ParticipanteRegistrado;
use Illuminate\Support\Facades\Redis;

class ActualizarContadorInscripciones 
{
    public function __construct()
    {
       
    }
    public function handle(ParticipanteRegistrado $event): void
    {     
         Redis::incr('contador_inscripciones');
    }
}
