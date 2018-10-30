<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DelegatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegates = auth()->user()->delegates()->simplePaginate();

        return view('dashboard.delegates', compact('delegates'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $delegates = auth()->user()->delegates()->where(function ($search) use ($request) {
            $search
                ->where('type', 'like', '%'.$request->search.'%')
                ->orWhere('username', 'like', '%'.$request->search.'%')
                ->orWhere('address', 'like', '%'.$request->search.'%');
        })->simplePaginate();

        return view('dashboard.delegates', compact('delegates'));
    }
}
