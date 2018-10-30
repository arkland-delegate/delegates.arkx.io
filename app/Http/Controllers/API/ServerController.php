<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Server as ServerResource;
use App\Models\Server;
use Spatie\QueryBuilder\QueryBuilder;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = QueryBuilder::for(Server::class)
            ->allowedFilters('type', 'network', 'cpu', 'ram', 'disk', 'connection')
            ->jsonPaginate();

        return ServerResource::collection($servers);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Server $server
     *
     * @return \App\Http\Resources\Delegate
     */
    public function show(Server $server)
    {
        return new ServerResource($server);
    }
}
