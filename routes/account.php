<?php

// Profile Settings
Route::get('settings/profile', 'Settings\Profile\ContactInformationController@showForm')->name('settings.profile');
Route::put('settings/profile', 'Settings\Profile\ContactInformationController@update');

// Password Settings
Route::get('settings/security/password', 'Settings\Security\PasswordController@showForm')->name('settings.security.password');
Route::put('settings/security/password', 'Settings\Security\PasswordController@update');

// Two-Factor Auth Settings
Route::get('settings/security/two-factor-auth', 'Settings\Security\TwoFactorAuthController@showForm')->name('settings.security.two-factor');
Route::post('settings/security/two-factor-auth', 'Settings\Security\TwoFactorAuthController@enable');
Route::delete('settings/security/two-factor-auth', 'Settings\Security\TwoFactorAuthController@disable');
