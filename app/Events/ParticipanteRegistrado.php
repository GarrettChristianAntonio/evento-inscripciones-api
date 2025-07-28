<?php

namespace App\Events;

use App\Models\Participante;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParticipanteRegistrado
{
    use Dispatchable, SerializesModels;

    public Participante $participante;

    public function __construct(Participante $participante)
    {       
        $this->participante = $participante;
    }
}
