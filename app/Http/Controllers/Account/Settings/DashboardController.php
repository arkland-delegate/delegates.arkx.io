<?php

namespace App\Http\Controllers\Account\Settings;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the settings dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return redirect()->route('account.settings.profile');
    }
}
