<?php

namespace App\Providers;

use App\Services\Navigation\Menus\Auth;
use App\Services\Navigation\Menus\Dashboard;
use App\Services\Navigation\Menus\Main;
use App\Services\Navigation\Menus\Tools;
use App\Services\Navigation\Menus\User;
use App\Services\Navigation\Tabs\Notifications;
use App\Services\Navigation\Tabs\Settings;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->bootMenus();
        $this->bootTabs();
    }

    /**
     * Register services.
     */
    public function register()
    {
        Menu::macro('iconRoute', function ($route, $icon, $title, $condition = true) {
            $link = Link::toRoute($route, sprintf('<i class="far fa-%s"></i>', $icon))->setAttribute('title', $title);

            return $this->addIf($condition, $link);
        });

        Menu::macro('iconLink', function ($url, $icon, $title) {
            $link = Link::toUrl($url, sprintf('<i class="far fa-%s"></i>', $icon))->setAttribute('title', $title);

            return $this->add($link);
        });

        Menu::macro('iconBadge', function ($route, $icon, $title, $condition) {
            $contents = sprintf('<i class="far fa-%s"></i>', $icon);

            if ($condition) {
                $contents .= Html::raw(sprintf('<span>%s</span>', $condition))->html();
            }

            $link = Link::toRoute($route, $contents);
            $link->setAttribute('title', $title);
            $link->setAttribute('class', 'notification-badge');

            return $this->add($link);
        });

        Menu::macro('icon', function () {
            return Menu::new()
                ->withoutWrapperTag()
                ->setActiveClass('icon-active')
                ->setActiveClassOnLink()
                ->setActiveClassOnParent(false)
                ->setActiveFromRequest();
        });

        Menu::macro('tabs', function () {
            return Menu::new()
                ->withoutWrapperTag()
                ->setActiveClass('button-active')
                ->setActiveClassOnLink()
                ->setActiveClassOnParent(false)
                ->setActiveFromRequest();
        });
    }

    /**
     * Bootstrap menus.
     */
    private function bootMenus()
    {
        $this->app->make(Auth::class)->register();
        $this->app->make(Dashboard::class)->register();
        $this->app->make(Main::class)->register();
        $this->app->make(Tools::class)->register();
        $this->app->make(User::class)->register();
    }

    /**
     * Bootstrap tabs.
     */
    private function bootTabs()
    {
        $this->app->make(Settings::class)->register();
        $this->app->make(Notifications::class)->register();
    }
}
