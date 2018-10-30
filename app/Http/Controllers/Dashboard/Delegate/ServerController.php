<?php

namespace App\Http\Controllers\Dashboard\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Delegate\StoreServer;
use App\Http\Requests\Dashboard\Delegate\UpdateServer;
use App\Models\Delegate;
use App\Models\Server;

class ServerController extends Controller
{
    public function index(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $servers = $delegate->servers()->simplePaginate();

        return view('dashboard.delegate.servers.index', compact('delegate', 'servers'));
    }

    public function create(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.servers.create', compact('delegate'));
    }

    public function store(StoreServer $request, Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $delegate->servers()->create($request->validated());

        alert()->success('The server is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.servers', $delegate);
    }

    public function edit(Delegate $delegate, Server $server)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.servers.edit', compact('delegate', 'server'));
    }

    public function update(UpdateServer $request, Delegate $delegate, Server $server)
    {
        $this->authorize('update', $delegate);

        $server->update($request->validated());

        alert()->success('The server is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.servers', $delegate);
    }

    public function destroy(Delegate $delegate, Server $server)
    {
        $this->authorize('update', $delegate);

        $server->delete();

        alert()->success('The server is being deleted! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.servers', $delegate);
    }

    public function duplicate(Delegate $delegate, Server $server)
    {
        $this->authorize('update', $delegate);

        $delegate->servers()->create($server->toArray());

        alert()->success('The server is being duplicated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.servers', $delegate);
    }
}
