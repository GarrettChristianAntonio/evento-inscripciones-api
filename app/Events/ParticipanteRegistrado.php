<?php

namespace App\Events;

use App\Models\Participante;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParticipanteRegistrado
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public Participante $participante;

    public function __construct(Participante $participante)
    {
        //
        $this->participante = $participante;
    }
}
