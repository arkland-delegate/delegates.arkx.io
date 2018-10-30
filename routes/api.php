<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('delegates', 'DelegateController@index');
Route::get('delegates/{delegate}', 'DelegateController@show');
Route::put('delegates/{delegate}', 'DelegateController@update');

Route::get('delegates/{delegate}/statuses', 'Delegate\StatusController@index');
Route::get('delegates/{delegate}/statuses/{status}', 'Delegate\StatusController@show');

Route::get('delegates/{delegate}/contributions', 'Delegate\ContributionController@index');
Route::get('delegates/{delegate}/contributions/{contribution}', 'Delegate\ContributionController@show');

Route::get('delegates/{delegate}/servers', 'Delegate\ServerController@index');
Route::get('delegates/{delegate}/servers/{server}', 'Delegate\ServerController@show');

Route::get('delegates/{delegate}/channels', 'Delegate\ChannelController@index');
Route::get('delegates/{delegate}/channels/{channel}', 'Delegate\ChannelController@show');

Route::get('delegates/{delegate}/team-members', 'Delegate\TeamMemberController@index');
Route::get('delegates/{delegate}/team-members/{teamMember}', 'Delegate\TeamMemberController@show');

Route::get('delegates/{delegate}/voters', 'Delegate\VoterController@index');
Route::get('delegates/{delegate}/voters/{voter}', 'Delegate\VoterController@show');

Route::get('statuses', 'StatusController@index');
Route::get('statuses/{status}', 'StatusController@show');

Route::get('contributions', 'ContributionController@index');
Route::get('contributions/{contribution}', 'ContributionController@show');

Route::get('servers', 'ServerController@index');
Route::get('servers/{server}', 'ServerController@show');

Route::get('channels', 'ChannelController@index');
Route::get('channels/{channel}', 'ChannelController@show');

Route::get('team-members', 'TeamMemberController@index');
Route::get('team-members/{teamMember}', 'TeamMemberController@show');

Route::get('voters', 'VoterController@index');
Route::get('voters/{voter}', 'VoterController@show');

Route::get('tags', 'TagController@index');
Route::get('tags/{tag}', 'TagController@show');
Route::get('tags/{tag}/delegates', 'TagController@delegates');
