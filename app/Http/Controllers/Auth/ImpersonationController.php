<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->only('impersonate');
        $this->middleware('role:delegate')->only('stopImpersonating');
    }

    /**
     * Impersonate the specified user.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function impersonate(Request $request, User $user): RedirectResponse
    {
        $request->session()->flush();

        $request->session()->put('arkx:impersonator', $request->user()->id);

        auth()->login($user);

        return redirect()->route('dashboard.home');
    }

    /**
     * Stop impersonating and switch back to primary account.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stopImpersonating(Request $request): RedirectResponse
    {
        $currentId = auth()->id();

        if (!$request->session()->has('arkx:impersonator')) {
            auth()->logout();

            return redirect('/');
        }

        $nextId = $request->session()->pull('arkx:impersonator');

        $request->session()->flush();

        auth()->login(User::findOrFail($nextId));

        return redirect()->route('home');
    }
}
