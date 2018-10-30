<?php

namespace App\Http\Controllers\Front\Delegate;

use App\Models\Delegate;
use App\Models\Status;
use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public function index(Delegate $delegate)
    {
        $statuses = $delegate->statuses()->latest()->simplePaginate();

        return view('front.delegate.statuses.index', compact('delegate', 'statuses'));
    }

    public function show(Delegate $delegate, Status $status)
    {
        return view('front.delegate.statuses.show', compact('delegate', 'status'));
    }
}
