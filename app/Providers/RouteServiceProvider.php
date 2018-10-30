<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Channel;
use App\Models\Contribution;
use App\Models\Delegate;
use App\Models\Server;
use App\Models\Status;
use App\Models\TeamMember;
use App\Models\Voter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Spatie\Tags\Tag;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();

        $this->registerRouteBindings();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapAuthRoutes();

        $this->mapAccountRoutes();

        $this->mapDashboardRoutes();

        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace("{$this->namespace}\\Front")
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "authentication" routes for the application.
     */
    protected function mapAuthRoutes()
    {
        Route::prefix('auth')
             ->middleware('web')
             ->namespace("{$this->namespace}\\Auth")
             ->group(base_path('routes/auth.php'));
    }

    /**
     * Define the "account" routes for the application.
     */
    protected function mapAccountRoutes()
    {
        Route::prefix('account')
             ->as('account.')
             ->middleware(['web', 'auth', 'verified', 'forbidden'])
             ->namespace("{$this->namespace}\\Account")
             ->group(base_path('routes/account.php'));
    }

    /**
     * Define the "dashboard" routes for the application.
     */
    protected function mapDashboardRoutes()
    {
        Route::prefix('dashboard')
             ->as('dashboard.')
             ->middleware(['web', 'auth', 'verified', 'role:delegate', 'forbidden'])
             ->namespace("{$this->namespace}\\Dashboard")
             ->group(base_path('routes/dashboard.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace.'\\API')
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the route model bindings for the application.
     */
    private function registerRouteBindings()
    {
        Route::bind('announcement', function ($value, $route) {
            return Announcement::whereSlug($value)->firstOrFail();
        });

        Route::bind('tag', function ($value, $route) {
            if (is_numeric($value)) {
                return Tag::findOrFail($value);
            }

            $locale = $locale ?? app()->getLocale();

            return Tag::query()
                ->where("slug->{$locale}", $value)
                ->firstOrFail();
        });

        Route::bind('delegate', function ($value, $route) {
            return is_numeric($value)
                ? Delegate::findOrFail($value)
                : Delegate::findByUsername($value);
        });

        Route::bind('status', function ($value, $route) {
            return is_numeric($value)
                ? Status::findOrFail($value)
                : Status::whereSlug($value)->firstOrFail();
        });

        Route::bind('voter', function ($value, $route) {
            return $route->delegate
                ->voters()
                ->findOrFail($value);
        });

        Route::bind('channel', function ($value, $route) {
            return $route->delegate
                ->channels()
                ->findOrFail($value);
        });

        Route::bind('server', function ($value, $route) {
            return $route->delegate
                ->servers()
                ->findOrFail($value);
        });

        Route::bind('teamMember', function ($value, $route) {
            return $route->delegate
                ->teamMembers()
                ->findOrFail($value);
        });

        Route::bind('contribution', function ($value, $route) {
            if (is_numeric($value)) {
                return $route->delegate->contributions()->findOrFail($value);
            }

            return $route->delegate
                ->contributions()
                ->whereSlug($value)
                ->firstOrFail();
        });
    }
}
