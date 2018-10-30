<?php

namespace App\Providers;

use App\Models\Country;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::defaultSimpleView('shared.paginator');

        try {
            View::share('countries', Country::pluck('name', 'id')->sort());
        } catch (\Exception $e) {
        }
    }
}
