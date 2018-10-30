<?php

namespace App\Services\Navigation\Tabs;

use Spatie\Menu\Laravel\Menu;

class Notifications
{
    public function register()
    {
        Menu::macro('notificationTabs', function () {
            return $this
                ->tabs()
                ->route('dashboard.notifications', 'All')
                ->route('dashboard.notifications.read', 'Read')
                ->route('dashboard.notifications.unread', 'Unread');
        });
    }
}
