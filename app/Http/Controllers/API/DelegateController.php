<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Delegate\UpdateDelegate;
use App\Http\Resources\Delegate as DelegateResource;
use App\Models\Delegate;
use Spatie\QueryBuilder\QueryBuilder;

class DelegateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegates = QueryBuilder::for(Delegate::class)
            ->allowedFilters('type', 'username', 'address', 'public_key', 'rank', 'votes')
            ->jsonPaginate();

        return DelegateResource::collection($delegates);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Delegate $delegate
     *
     * @return \App\Http\Resources\Delegate
     */
    public function show(Delegate $delegate): DelegateResource
    {
        return new DelegateResource($delegate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Delegate     $delegate
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDelegate $request, Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        // Valid data
        $data = $request->validated();

        // Update model
        $delegate->update(array_only($data, ['type', 'country_id']));

        // Update tags
        if ($request->get('tags')) {
            $tags = explode(',', $request->get('tags'));

            $delegate->syncTags(array_map('trim', $tags));
        }

        // Update Meta
        $delegate->extra_attributes->set('calculator', $data['calculator']);
        $delegate->extra_attributes->set('profile', $data['profile']);
        $delegate->extra_attributes->set('sharing', $data['sharing']);
        $delegate->extra_attributes->set('voting', $data['voting']);

        // Save
        $delegate->save();

        return (new DelegateResource($delegate))
            ->response()
            ->setStatusCode(202);
    }
}
