<?php

namespace App\Http\Controllers\Dashboard\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Delegate\StoreContribution;
use App\Http\Requests\Dashboard\Delegate\UpdateContribution;
use App\Models\Contribution;
use App\Models\Delegate;

class ContributionController extends Controller
{
    public function index(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $contributions = $delegate->contributions()->simplePaginate();

        return view('dashboard.delegate.contributions.index', compact('delegate', 'contributions'));
    }

    public function create(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.contributions.create', compact('delegate'));
    }

    public function store(StoreContribution $request, Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $delegate->contributions()->create($request->validated());

        alert()->success('The contribution is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.contributions', $delegate);
    }

    public function edit(Delegate $delegate, Contribution $contribution)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.contributions.edit', compact('delegate', 'contribution'));
    }

    public function update(UpdateContribution $request, Delegate $delegate, Contribution $contribution)
    {
        $this->authorize('update', $delegate);

        $contribution->update($request->validated());

        alert()->success('The contribution is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.contributions', $delegate);
    }

    public function destroy(Delegate $delegate, Contribution $contribution)
    {
        $this->authorize('update', $delegate);

        $contribution->delete();

        alert()->success('The contribution is being deleted! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.contributions', $delegate);
    }
}
