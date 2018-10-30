<?php

namespace App\Http\Controllers\Dashboard\Delegate;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Voter;

class VoterController extends Controller
{
    public function index(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $voters = $delegate->voters()->latest()->simplePaginate();

        return view('dashboard.delegate.voters', compact('delegate', 'voters'));
    }

    public function include(Delegate $delegate, Voter $voter)
    {
        $this->authorize('update', $delegate);

        $voter->update(['is_excluded' => false]);

        alert()->success('The voter information is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.voters', $delegate);
    }

    public function exclude(Delegate $delegate, Voter $voter)
    {
        $this->authorize('update', $delegate);

        $voter->update(['is_excluded' => true]);

        alert()->success('The voter information is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.voters', $delegate);
    }
}
