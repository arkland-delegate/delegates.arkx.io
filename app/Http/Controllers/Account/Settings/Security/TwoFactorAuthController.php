<?php

namespace App\Http\Controllers\Account\Settings\Security;

use App\Facades\Authy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Settings\Security\EnableTwoFactorAuthRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class TwoFactorAuthController extends Controller
{
    /**
     * Show the two-factor authentication settings.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function showForm(Request $request): View
    {
        return view('account.settings.security.two-factor-auth');
    }

    /**
     * Enable two-factor authentication for the user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(EnableTwoFactorAuthRequest $request): RedirectResponse
    {
        $request->user()->forceFill([
            'uses_two_factor_auth'  => true,
            'authy_id'              => Authy::enable($request->user()->email, $request->phone, $request->country_code),
            'two_factor_reset_code' => Hash::make($resetCode = Uuid::uuid4()),
        ])->save();

        return back()->with('resetCode', $resetCode);
    }

    /**
     * Disable two-factor authentication for the user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Request $request): RedirectResponse
    {
        Authy::disable($request->user()->authy_id);

        $request->user()->forceFill([
            'uses_two_factor_auth'  => false,
            'authy_id'              => null,
            'two_factor_reset_code' => null,
        ])->save();

        alert()->info('Two-Factor authentication is being disabled! The changes should be reflected in a moment.');

        return back();
    }
}
