<?php

namespace App\Services\Navigation\Menus;

use Spatie\Menu\Laravel\Menu;

class Auth
{
    public function register()
    {
        Menu::macro('auth', function () {
            return $this
                ->icon()
                ->iconRoute('login', 'sign-out', 'Login')
                ->iconRoute('register', 'user-plus', 'Register');
        });
    }
}
