<?php

namespace App\Http\Controllers\Front\Delegate;

use App\Models\Delegate;
use App\Models\TeamMember;
use Illuminate\Routing\Controller;

class TeamMemberController extends Controller
{
    public function index(Delegate $delegate)
    {
        $teamMembers = $delegate->teamMembers()->latest()->simplePaginate();

        return view('front.delegate.team-members.index', compact('delegate', 'teamMembers'));
    }

    public function show(Delegate $delegate, TeamMember $teamMember)
    {
        return view('front.delegate.team-members.show', compact('delegate', 'teamMember'));
    }
}
