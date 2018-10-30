<?php

namespace App\Http\Controllers\API\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Resources\Channel as ChannelResource;
use App\Models\Channel;
use App\Models\Delegate;
use Spatie\QueryBuilder\QueryBuilder;

class ChannelController extends Controller
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
        $channels = QueryBuilder::for(Channel::class)
            ->allowedFilters('name', 'handle', 'location')
            ->where('delegate_id', $delegate->id)
            ->jsonPaginate();

        return ChannelResource::collection($channels);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Delegate $delegate
     * @param \App\Models\Channel  $channel
     *
     * @return \App\Http\Resources\Delegate
     */
    public function show(Delegate $delegate, Channel $channel)
    {
        return new ChannelResource($channel);
    }
}
