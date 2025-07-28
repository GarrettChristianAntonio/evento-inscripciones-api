<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
     /**
     * Register services.
     */
    protected $listen = [
        \App\Events\ParticipanteRegistrado::class => [
            \App\Listeners\EnviarCorreoBienvenida::class,
            \App\Listeners\ActualizarContadorInscripciones::class,
        ],
    ];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
