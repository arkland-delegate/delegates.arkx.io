<?php

namespace App\Http\Controllers\Account\Settings\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Settings\Security\ChangePassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PasswordController extends Controller
{
    /**
     * Show the settings dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function showForm(): View
    {
        return view('account.settings.security.password');
    }

    /**
     * Update the user's password.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChangePassword $request): RedirectResponse
    {
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json([
                'errors' => [
                    'current_password' => ['The given password does not match our records.'],
                ],
            ], 422);
        }

        $request->user()->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        alert()->success('Your password is being updated! The changes should be reflected in a moment.');

        return back();
    }
}
