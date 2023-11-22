<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Passport::hashClientSecrets();

        if (!$this->app->routesAreCached()) {
            //Override the default routes for Passport
            Route::get('/oauth/authorize', [
                'uses' => '\Laravel\Passport\Http\Controllers\AuthorizationController@authorize',
                'as' => 'passport.authorizations.authorize',
            ])->middleware(['web', 'auth', 'has.access']);
        }

        Passport::tokensExpireIn(now()->addMinutes(30));
        Passport::refreshTokensExpireIn(now()->addMinutes(60));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
