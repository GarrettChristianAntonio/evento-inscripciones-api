<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        \App\Events\ParticipanteRegistrado::class => [
            \App\Listeners\EnviarCorreoBienvenida::class,
            \App\Listeners\ActualizarContadorInscripciones::class,
        ],
    ];

    public function boot(): void
    {
        
    }
}
