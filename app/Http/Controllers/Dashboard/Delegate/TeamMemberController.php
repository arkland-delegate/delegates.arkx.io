<?php

namespace App\Http\Controllers\Dashboard\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Delegate\StoreTeamMember;
use App\Http\Requests\Dashboard\Delegate\UpdateTeamMember;
use App\Models\Delegate;
use App\Models\TeamMember;

class TeamMemberController extends Controller
{
    public function index(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $teamMembers = $delegate->teamMembers()->simplePaginate();

        return view('dashboard.delegate.team-members.index', compact('delegate', 'teamMembers'));
    }

    public function create(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.team-members.create', compact('delegate'));
    }

    public function store(StoreTeamMember $request, Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $delegate->teamMembers()->create($request->validated());

        alert()->success('The team member is being created! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.team-members', $delegate);
    }

    public function edit(Delegate $delegate, TeamMember $teamMember)
    {
        $this->authorize('update', $delegate);

        return view('dashboard.delegate.team-members.edit', compact('delegate', 'teamMember'));
    }

    public function update(UpdateTeamMember $request, Delegate $delegate, TeamMember $teamMember)
    {
        $this->authorize('update', $delegate);

        $teamMember->update($request->validated());

        alert()->success('The team member is being updated! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.team-members', $delegate);
    }

    public function destroy(Delegate $delegate, TeamMember $teamMember)
    {
        $this->authorize('update', $delegate);

        $teamMember->delete();

        alert()->success('The team member is being deleted! The changes should be reflected in a moment.');

        return redirect()->route('dashboard.delegate.team-members', $delegate);
    }
}
