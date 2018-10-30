<?php

namespace App\Http\Controllers\API\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Resources\Server as ServerResource;
use App\Models\Delegate;
use App\Models\Server;
use Spatie\QueryBuilder\QueryBuilder;

class ServerController extends Controller
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
        $servers = QueryBuilder::for(Server::class)
            ->allowedFilters('type', 'network', 'cpu', 'ram', 'disk', 'connection')
            ->where('delegate_id', $delegate->id)
            ->jsonPaginate();

        return ServerResource::collection($servers);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Delegate $delegate
     * @param \App\Models\Server   $server
     *
     * @return \App\Http\Resources\Delegate
     */
    public function show(Delegate $delegate, Server $server)
    {
        return new ServerResource($server);
    }
}
