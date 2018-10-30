<?php

// Home...
Route::get('/', 'DashboardController@index')->name('home');

// Notifications
Route::get('notifications/all', 'NotificationController@index')->name('notifications');
Route::get('notifications/read', 'NotificationController@read')->name('notifications.read');
Route::get('notifications/unread', 'NotificationController@unread')->name('notifications.unread');
Route::post('notifications/{notification}/mark-as-read', 'NotificationController@markAsRead')->name('notifications.mark-as-read');

// Lost & Found
Route::get('lost-and-found', 'LostAndFoundController@index')->name('lost-and-found');
Route::post('lost-and-found/search', 'LostAndFoundController@search')->name('lost-and-found.search');
Route::get('lost-and-found/{delegate}', 'LostAndFoundController@claim')->name('lost-and-found.claim');
Route::post('lost-and-found/{delegate}', 'LostAndFoundController@verifyClaim');

// Delegates...
Route::get('delegates', 'DelegatesController@index')->name('delegates');
Route::post('delegates/search', 'DelegatesController@search')->name('delegates.search');
Route::get('delegates/create', 'DelegatesController@create')->name('delegates.create');
Route::post('delegates', 'DelegatesController@store');

// Delegate...
Route::get('delegates/{delegate}', 'Delegate\DelegateController@edit')->name('delegate');
Route::put('delegates/{delegate}', 'Delegate\DelegateController@update');

// Delegate - Statuses...
Route::get('delegates/{delegate}/statuses', 'Delegate\StatusController@index')->name('delegate.statuses');
Route::get('delegates/{delegate}/statuses/create', 'Delegate\StatusController@create')->name('delegate.statuses.create');
Route::post('delegates/{delegate}/statuses', 'Delegate\StatusController@store');
Route::get('delegates/{delegate}/statuses/{status}', 'Delegate\StatusController@edit')->name('delegate.statuses.edit');
Route::put('delegates/{delegate}/statuses/{status}', 'Delegate\StatusController@update');
Route::delete('delegates/{delegate}/statuses/{status}', 'Delegate\StatusController@destroy')->name('delegate.statuses.destroy');
Route::post('delegates/{delegate}/statuses/search', 'Delegate\StatusController@search')->name('delegate.statuses.search');

// Delegate - Statuses...
Route::get('delegates/{delegate}/team-members', 'Delegate\TeamMemberController@index')->name('delegate.team-members');
Route::get('delegates/{delegate}/team-members/create', 'Delegate\TeamMemberController@create')->name('delegate.team-members.create');
Route::post('delegates/{delegate}/team-members', 'Delegate\TeamMemberController@store');
Route::get('delegates/{delegate}/team-members/{teamMember}', 'Delegate\TeamMemberController@edit')->name('delegate.team-members.edit');
Route::put('delegates/{delegate}/team-members/{teamMember}', 'Delegate\TeamMemberController@update');
Route::delete('delegates/{delegate}/team-members/{teamMember}', 'Delegate\TeamMemberController@destroy')->name('delegate.team-members.destroy');
Route::post('delegates/{delegate}/team-members/search', 'Delegate\TeamMemberController@search')->name('delegate.team-members.search');

// Delegate - Contributions...
Route::get('delegates/{delegate}/contributions', 'Delegate\ContributionController@index')->name('delegate.contributions');
Route::get('delegates/{delegate}/contributions/create', 'Delegate\ContributionController@create')->name('delegate.contributions.create');
Route::post('delegates/{delegate}/contributions', 'Delegate\ContributionController@store');
Route::get('delegates/{delegate}/contributions/{contribution}', 'Delegate\ContributionController@edit')->name('delegate.contributions.edit');
Route::put('delegates/{delegate}/contributions/{contribution}', 'Delegate\ContributionController@update');
Route::delete('delegates/{delegate}/contributions/{contribution}', 'Delegate\ContributionController@destroy')->name('delegate.contributions.destroy');
Route::post('delegates/{delegate}/contributions/search', 'Delegate\ContributionController@search')->name('delegate.contributions.search');

// Delegate - Servers...
Route::get('delegates/{delegate}/servers', 'Delegate\ServerController@index')->name('delegate.servers');
Route::get('delegates/{delegate}/servers/create', 'Delegate\ServerController@create')->name('delegate.servers.create');
Route::post('delegates/{delegate}/servers', 'Delegate\ServerController@store');
Route::get('delegates/{delegate}/servers/{server}', 'Delegate\ServerController@edit')->name('delegate.servers.edit');
Route::put('delegates/{delegate}/servers/{server}', 'Delegate\ServerController@update');
Route::delete('delegates/{delegate}/servers/{server}', 'Delegate\ServerController@destroy')->name('delegate.servers.destroy');
Route::post('delegates/{delegate}/servers/search', 'Delegate\ServerController@search')->name('delegate.servers.search');
Route::get('delegates/{delegate}/servers/{server}/duplicate', 'Delegate\ServerController@duplicate')->name('delegate.servers.duplicate');

// Delegate - Channels...
Route::get('delegates/{delegate}/channels', 'Delegate\ChannelController@index')->name('delegate.channels');
Route::get('delegates/{delegate}/channels/create', 'Delegate\ChannelController@create')->name('delegate.channels.create');
Route::post('delegates/{delegate}/channels', 'Delegate\ChannelController@store');
Route::get('delegates/{delegate}/channels/{channel}', 'Delegate\ChannelController@edit')->name('delegate.channels.edit');
Route::put('delegates/{delegate}/channels/{channel}', 'Delegate\ChannelController@update');
Route::delete('delegates/{delegate}/channels/{channel}', 'Delegate\ChannelController@destroy')->name('delegate.channels.destroy');
Route::post('delegates/{delegate}/channels/search', 'Delegate\ChannelController@search')->name('delegate.channels.search');

// Delegate - Voters...
Route::get('delegates/{delegate}/voters', 'Delegate\VoterController@index')->name('delegate.voters');
Route::post('delegates/{delegate}/voters/search', 'Delegate\VoterController@search')->name('delegate.voters.search');
Route::get('delegates/{delegate}/voters/{voter}/include', 'Delegate\VoterController@include')->name('delegate.voters.include');
Route::get('delegates/{delegate}/voters/{voter}/exclude', 'Delegate\VoterController@exclude')->name('delegate.voters.exclude');
