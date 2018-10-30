<?php

namespace App\Services\Navigation\Menus;

use App\Models\Announcement;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class Main
{
    public function register()
    {
        Menu::macro('main', function () {
            return $this
                ->icon()
                ->iconRoute('home', 'home', 'Home')
                ->registerFilter(function (Link $link) {
                    $link->addClass('mb-5');
                })
                ->iconBadge('announcements', 'bullhorn', 'Announcements', Announcement::get()->filter->is_recent->count());
        });
    }
}
