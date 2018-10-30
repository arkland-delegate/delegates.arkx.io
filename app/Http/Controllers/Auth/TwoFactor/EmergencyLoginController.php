<?php

namespace App\Http\Controllers\Auth\TwoFactor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class EmergencyLoginController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new emergency login controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('throttle:3,1')->only('login');
    }

    /**
     * Show the form to login via the emergency token.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): View
    {
        return view('auth.two-factor.emergency-token');
    }

    /**
     * Login via the emergency token.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $this->validate($request, ['token' => 'required']);

        if (!$request->session()->has('arkx:auth:id')) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($request->session()->pull('arkx:auth:id'));

        if (!Hash::check($request->token, $user->two_factor_reset_code)) {
            alert()->error('The emergency token was invalid.');

            return redirect()->route('login');
        }

        $this->disableTwoFactorAuth($user);

        auth()->login($user);

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Disable two-factor authentication for the specified user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    protected function disableTwoFactorAuth(Authenticatable $user): void
    {
        $user->forceFill([
            'uses_two_factor_auth'  => false,
            'authy_id'              => null,
            'two_factor_reset_code' => null,
        ])->save();
    }
}
