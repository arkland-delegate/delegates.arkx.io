<?php

namespace App\Http\Controllers\Auth\TwoFactor;

use App\Facades\Authy;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        AuthenticatesUsers::login as traitLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new login controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.two-factor.login');
    }

    /**
     * Verify the specified one-time password.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'token' => ['required', 'integer'],
        ]);

        if (!$request->session()->has('arkx:auth:id')) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($request->session()->pull('arkx:auth:id'));

        if (Authy::verify($user->authy_id, $request->token)) {
            auth()->login($user);

            return redirect()->intended($this->redirectPath());
        }

        alert()->error('The provided one-time password was invalid.');

        return redirect()->route('login');
    }
}
