<?php

namespace App\Services\Navigation\Menus;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class Tools
{
    public function register()
    {
        Menu::macro('tools', function () {
            return $this
                ->icon()
                ->iconLink('delegates', 'server', 'Delegates')
                ->iconLink('calculator', 'calculator', 'Calculator')
                ->registerFilter(function (Link $link) {
                    $link->addClass('mb-5');
                })
                ->iconLink('tags', 'hashtag', 'Tags');
        });
    }
}
