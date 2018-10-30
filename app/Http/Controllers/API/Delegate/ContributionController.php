<?php

namespace App\Http\Controllers\API\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Resources\Contribution as ContributionResource;
use App\Models\Contribution;
use App\Models\Delegate;
use Spatie\QueryBuilder\QueryBuilder;

class ContributionController extends Controller
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
        $contributions = QueryBuilder::for(Contribution::class)
            ->allowedFilters('title', 'body')
            ->where('delegate_id', $delegate->id)
            ->jsonPaginate();

        return ContributionResource::collection($contributions);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Delegate     $delegate
     * @param \App\Models\Contribution $contribution
     *
     * @return \App\Http\Resources\Delegate
     */
    public function show(Delegate $delegate, Contribution $contribution)
    {
        return new ContributionResource($contribution);
    }
}
