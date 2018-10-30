<?php

namespace App\Http\Controllers\API\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamMember as TeamMemberResource;
use App\Models\Delegate;
use App\Models\TeamMember;
use Spatie\QueryBuilder\QueryBuilder;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Delegate $delegate
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Delegate $delegate)
    {
        $teamMembers = QueryBuilder::for(TeamMember::class)
            ->allowedFilters('name', 'role', 'body')
            ->where('delegate_id', $delegate->id)
            ->jsonPaginate();

        return TeamMemberResource::collection($teamMembers);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Delegate   $delegate
     * @param \App\Models\TeamMember $teamMember
     *
     * @return \App\Http\Resources\Delegate
     */
    public function show(Delegate $delegate, TeamMember $teamMember)
    {
        return new TeamMemberResource($teamMember);
    }
}
