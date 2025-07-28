<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   // No se requieren bindings ni bootstrapping adicionales en este provider para este caso de uso
    public function register(): void
    {
        
    }

    public function boot(): void
    {
       
    }
}
