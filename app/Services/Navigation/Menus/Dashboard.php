<?php

namespace App\Services\Navigation\Menus;

use Spatie\Menu\Laravel\Menu;

class Dashboard
{
    public function register()
    {
        Menu::macro('dashboard', function () {
            return $this
                ->icon()
                ->iconBadge('dashboard.notifications', 'bell', 'Notifications', auth()->user()->unreadNotifications->count())
                ->iconRoute('dashboard.lost-and-found', 'fingerprint', 'Lost & Found')
                ->iconRoute('dashboard.delegates', 'user-graduate', 'Delegates');
        });
    }
}
