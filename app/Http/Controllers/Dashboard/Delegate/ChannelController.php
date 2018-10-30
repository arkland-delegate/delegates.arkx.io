<?php

namespace App\Http\Controllers\Dashboard\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Delegate\StoreChannel;
use App\Http\Requests\Dashboard\Delegate\UpdateChannel;
use App\Models\Channel;
use App\Models\Delegate;

class ChannelController extends Controller
{
    public function index(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $channels = $delegate->channels()->simplePaginate();

        return view('dashboard.delegate.channels.index', compact('delegate', 'channels'));
    }

    public function create(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.channels.create', compact('delegate'));
    }

    public function store(StoreChannel $request, Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $delegate->channels()->create($request->validated());

        alert()->success('The channel is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.channels', $delegate);
    }

    public function edit(Delegate $delegate, Channel $channel)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.channels.edit', compact('delegate', 'channel'));
    }

    public function update(UpdateChannel $request, Delegate $delegate, Channel $channel)
    {
        $this->authorize('update', $delegate);

        $channel->update($request->validated());

        alert()->success('The channel is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.channels', $delegate);
    }

    public function destroy(Delegate $delegate, Channel $channel)
    {
        $this->authorize('update', $delegate);

        $channel->delete();

        alert()->success('The channel is being deleted! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.channels', $delegate);
    }
}
