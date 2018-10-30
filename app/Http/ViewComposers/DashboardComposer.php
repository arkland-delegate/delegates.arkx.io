<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class DashboardComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('unreadNotifications', auth()->user()->unreadNotifications->count());
    }
}
