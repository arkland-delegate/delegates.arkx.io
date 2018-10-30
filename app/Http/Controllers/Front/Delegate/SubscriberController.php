<?php

namespace App\Http\Controllers\Front\Delegate;

use App\Models\Delegate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class SubscriberController extends Controller
{
    public function store(Request $request, Delegate $delegate)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $subscriber = $delegate->subscribers()->where($data)->firstOrFail();
            $subscriber->delete();

            alert()->info('You have been successfully unsubscribed! From now on we will be no longer bringing you any updates about this delegate.');

            $cookie = Cookie::forever("subscribed_{$delegate->username}", 'no');
        } catch (Exception $e) {
            $delegate->subscribers()->create($data);

            alert()->info('You have been successfully subscribed! From now on we will be bringing you all the latest updates about this delegate.');

            $cookie = Cookie::forever("subscribed_{$delegate->username}", 'yes');
        }

        return back()->cookie($cookie);
    }
}
