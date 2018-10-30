<?php

// Login
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');

// Email Verification
Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

// Magic Login
Route::get('login/magic', 'MagicLoginController@showLoginForm')->name('login.magic.request');
Route::post('login/magic', 'MagicLoginController@sendMagicLinkEmail');
Route::get('login/magic/{user}', 'MagicLoginController@login')->name('login.magic');

// Two-Factor Login
Route::prefix('two-factor')->namespace('TwoFactor')->group(function () {
    // Login
    Route::get('login', 'LoginController@showLoginForm')->name('two-factor.login');
    Route::post('login', 'LoginController@login');

    // Emergency Token Login
    Route::get('emergency', 'EmergencyLoginController@showLoginForm')->name('two-factor.emergency');
    Route::post('emergency', 'EmergencyLoginController@login');
});

// Registration
Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'RegisterController@register');

// Password
Route::prefix('password')->namespace('Password')->group(function () {
    // Forgot
    Route::get('reset', 'ForgotController@showLinkRequestForm')->name('password.request');
    Route::post('email', 'ForgotController@sendResetLinkEmail')->name('password.email');

    // Reset
    Route::get('reset/{token}', 'ResetController@showResetForm')->name('password.reset');
    Route::post('reset', 'ResetController@reset');
});

// Impersonation
Route::prefix('impersonation')->group(function () {
    Route::get('stop', 'ImpersonationController@stopImpersonating')->name('impersonation.stop');
    Route::get('{user}', 'ImpersonationController@impersonate')->name('impersonation.start');
});

// Logout
Route::get('logout', 'LoginController@logout')->name('logout');
