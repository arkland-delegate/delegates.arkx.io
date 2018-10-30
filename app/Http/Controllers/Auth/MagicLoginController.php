<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Notifications\MagicLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MagicLoginController extends LoginController
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.magic-login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function sendMagicLinkEmail(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')],
        ]);

        $user = User::findByEmail($data['email']);
        $user->notify(new MagicLink());

        alert()->success("We sent an email to you at {$user->email}. It has a magic link that'll sign you in.");

        return back();
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (!$request->hasValidSignature()) {
            alert()->error('The magic link seems to have expired, please try requesting a new one and try again.');

            return redirect()->route('login');
        }

        auth()->login(User::findOrFail($request->route('user')));

        return $this->sendLoginResponse($request);
    }
}
