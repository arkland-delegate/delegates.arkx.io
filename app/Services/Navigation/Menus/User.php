<?php

namespace App\Services\Navigation\Menus;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class User
{
    public function register()
    {
        Menu::macro('user', function () {
            return $this
                ->icon()
                ->iconRoute('account.settings.profile', 'cog', 'Settings')
                ->iconRoute('impersonation.stop', 'user-secret', 'Stop Impersonating', session()->has('arkx:impersonator'))
                ->registerFilter(function (Link $link) {
                    $link->addClass('mt-5');
                })
                ->iconRoute('logout', 'sign-out', 'Logout');
        });
    }
}
