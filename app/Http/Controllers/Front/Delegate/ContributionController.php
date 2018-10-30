<?php

namespace App\Http\Controllers\Front\Delegate;

use App\Models\Contribution;
use App\Models\Delegate;
use Illuminate\Routing\Controller;

class ContributionController extends Controller
{
    public function index(Delegate $delegate)
    {
        $contributions = $delegate->contributions()->latest()->simplePaginate();

        return view('front.delegate.contributions.index', compact('delegate', 'contributions'));
    }

    public function show(Delegate $delegate, Contribution $contribution)
    {
        return view('front.delegate.contributions.show', compact('delegate', 'contribution'));
    }
}
