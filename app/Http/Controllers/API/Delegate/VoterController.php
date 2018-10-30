<?php

namespace App\Http\Controllers\API\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Resources\Voter as VoterResource;
use App\Models\Delegate;
use App\Models\Voter;
use Spatie\QueryBuilder\QueryBuilder;

class VoterController extends Controller
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
        $voters = QueryBuilder::for(Voter::class)
            ->allowedFilters('address', 'balance', 'is_excluded')
            ->where('delegate_id', $delegate->id)
            ->jsonPaginate();

        return VoterResource::collection($voters);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Delegate $delegate
     * @param \App\Models\Voter    $voter
     *
     * @return \App\Http\Resources\Delegate
     */
    public function show(Delegate $delegate, Voter $voter)
    {
        return new VoterResource($voter);
    }
}
