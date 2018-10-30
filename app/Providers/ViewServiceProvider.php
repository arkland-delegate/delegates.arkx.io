<?php

namespace App\Providers;

use App\Http\ViewComposers\Shared\EncryptedCsrfTokenComposer;
use App\Http\ViewComposers\Shared\GlobalViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', GlobalViewComposer::class);
        View::composer('*.layouts.*', EncryptedCsrfTokenComposer::class);
    }
}
