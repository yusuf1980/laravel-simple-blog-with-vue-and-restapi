<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Passport::routes(function ($router) {
        //     $router->forAccessTokens();
        // });
        // Passport::tokensExpireIn(Carbon::now()->addMinutes(10));
        // Passport::tokensExpireIn(Carbon::now()->addHours(6));
        Passport::tokensExpireIn(Carbon::now()->addHours(1));

        Passport::refreshTokensExpireIn(Carbon::now()->addHours(6));
    }
}
