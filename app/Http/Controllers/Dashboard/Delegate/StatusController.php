<?php

namespace App\Http\Controllers\Dashboard\Delegate;

use App\Events\StatusWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Delegate\StoreStatus;
use App\Http\Requests\Dashboard\Delegate\UpdateStatus;
use App\Models\Delegate;
use App\Models\Status;

class StatusController extends Controller
{
    public function index(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $statuses = $delegate->statuses()->simplePaginate();

        return view('dashboard.delegate.statuses.index', compact('delegate', 'statuses'));
    }

    public function create(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.statuses.create', compact('delegate'));
    }

    public function store(StoreStatus $request, Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $status = $delegate->statuses()->create($request->validated());

        event(new StatusWasCreated($status));

        alert()->success('The status is being created! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.statuses', $delegate);
    }

    public function edit(Delegate $delegate, Status $status)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.statuses.edit', compact('delegate', 'status'));
    }

    public function update(UpdateStatus $request, Delegate $delegate, Status $status)
    {
        $this->authorize('update', $delegate);

        $status->update($request->validated());

        alert()->success('The status is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.statuses', $delegate);
    }

    public function destroy(Delegate $delegate, Status $status)
    {
        $this->authorize('update', $delegate);

        $status->delete();

        alert()->success('The status is being deleted! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.statuses', $delegate);
    }
}
