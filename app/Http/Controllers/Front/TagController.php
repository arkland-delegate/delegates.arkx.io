<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use Spatie\Tags\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::simplePaginate();

        return view('front.tags', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $delegates = Delegate::withAnyTags([$tag])->simplePaginate();

        return view('front.delegates', compact('delegates'));
    }
}
