<?php

namespace App\Http\ViewComposers\Shared;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class GlobalViewComposer
{
    public function compose(View $view)
    {
        $view->with('currentUser', auth()->user());

        if (auth()->check()) {
            $view->with('unreadNotifications', auth()->user()->unreadNotifications->count());
        }

        $view->with('forgingTotals', Cache::get('forging.totals'));
    }
}
