<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home...
Route::get('/', 'HomeController@index')->name('home');

// Announcements...
Route::get('announcements', 'AnnouncementController@index')->name('announcements');
Route::post('announcements/search', 'AnnouncementController@search')->name('announcements.search');
Route::get('announcements/{announcement}', 'AnnouncementController@show')->name('announcement');

// Calculator...
Route::get('calculator', 'CalculatorController@index')->name('calculator');
Route::post('calculator', 'CalculatorController@calculate');

// Delegates...
Route::get('delegates', 'DelegatesController@index')->name('delegates');

// Delegates...
Route::get('tags', 'TagController@index')->name('tags');
Route::get('tags/{tag}', 'TagController@show')->name('tag');

// Delegate...
Route::get('delegates/{delegate}', 'DelegateController@show')->name('delegate');

// Delegate Subscribers...
Route::post('delegates/{delegate}/subscribe', 'Delegate\SubscriberController@store')->name('delegate.subscribe');

// Delegate Statuses...
Route::get('delegates/{delegate}/statuses', 'Delegate\StatusController@index')->name('delegate.statuses');
Route::get('delegates/{delegate}/statuses/{status}', 'Delegate\StatusController@show')->name('delegate.status');

// Delegate Contributions...
Route::get('delegates/{delegate}/contributions', 'Delegate\ContributionController@index')->name('delegate.contributions');
Route::get('delegates/{delegate}/contributions/{contribution}', 'Delegate\ContributionController@show')->name('delegate.contribution');

// Delegate Team Members...
Route::get('delegates/{delegate}/team-members', 'Delegate\TeamMemberController@index')->name('delegate.team-members');
Route::get('delegates/{delegate}/team-members/{teamMember}', 'Delegate\TeamMemberController@show')->name('delegate.team-member');

// Delegate Voters...
Route::get('delegates/{delegate}/voters', 'Delegate\VoterController@index')->name('delegate.voters');
