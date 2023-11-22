<?php

namespace App\Providers;

use App\Models\Client;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
    public function boot(UrlGenerator $url): void
    {
        Passport::useClientModel(Client::class);
      
        if (config('app.env') == 'production') {
            $url->forceScheme('https');
        }
    }
}
