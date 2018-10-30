<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CalculatorController extends Controller
{
    public function index(Request $request)
    {
        $delegates = Cache::get('calculator');

        return view('front.calculator.index', compact('delegates'));
    }
}
