<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        //
    if ($this->app->environment('production', 'staging', 'development')) {
        // Force semua skema URL yang dihasilkan menjadi HTTPS
        URL::forceScheme('https');
    }
    }
}
