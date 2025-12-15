<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Tambahan 1: Import Facade URL

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // <-- Tambahan 2: Paksa HTTPS saat di production (Render)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
