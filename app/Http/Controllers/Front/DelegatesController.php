<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Delegate;

class DelegatesController extends Controller
{
    public function index()
    {
        $delegates = Delegate::simplePaginate();

        return view('front.delegates', compact('delegates'));
    }

    public function search(SearchRequest $request)
    {
        $delegates = Delegate::where(function ($search) use ($request) {
            $search
                ->where('type', 'like', '%'.$request->search.'%')
                ->where('username', 'like', '%'.$request->search.'%')
                ->where('address', 'like', '%'.$request->search.'%')
                ->where('public_key', 'like', '%'.$request->search.'%');
        })->simplePaginate();

        return view('front.delegates', compact('delegates'));
    }
}
