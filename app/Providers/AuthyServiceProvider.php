<?php

namespace App\Providers;

use App\Services\Security\Authy;
use Illuminate\Support\ServiceProvider;

class AuthyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('authy', function ($app) {
            return new Authy(config('services.authy.secret'));
        });
    }
}
