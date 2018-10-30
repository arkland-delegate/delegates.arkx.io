<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use Illuminate\Support\Facades\Cookie;

class DelegateController extends Controller
{
    public function show(Delegate $delegate)
    {
        $voters = $delegate->cached_voters
            ->where('balance', '>=', ARKTOSHI)
            ->sortByDesc('balance')
            ->take(10);

        return view('front.delegate.index', compact('delegate', 'voters') + [
            'teamMembers'   => $delegate->cached_team_members->take(10),
            'statuses'      => $delegate->cached_statuses->take(10),
            'contributions' => $delegate->cached_contributions->take(10),
            'subscribed'    => Cookie::get("subscribed_{$delegate->username}"),
        ]);
    }
}
