<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\FiltersTags;
use App\Http\Resources\Delegate as DelegateResource;
use App\Http\Resources\Tag as TagResource;
use App\Models\Delegate;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Tags\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = QueryBuilder::for(Tag::class)
            ->allowedFilters('title', 'body')
            ->jsonPaginate();

        return TagResource::collection($tags);
    }

    /**
     * Display the specified resource.
     *
     * @param \Spatie\Tags\Tag $tag
     *
     * @return \App\Http\Resources\Tag
     */
    public function show(Tag $tag): TagResource
    {
        return new TagResource($tag);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Spatie\Tags\Tag $tag
     *
     * @return \Illuminate\Http\Response
     */
    public function delegates(Tag $tag)
    {
        $delegates = QueryBuilder::for(Delegate::class)
            ->allowedFilters(Filter::custom('tags', FiltersTags::class))
            ->jsonPaginate();

        return DelegateResource::collection($delegates);
    }
}
