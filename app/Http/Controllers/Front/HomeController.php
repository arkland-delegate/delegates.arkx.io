<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Delegate;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.forging', [
            'delegates' => Delegate::forging()->get(),
        ]);
    }
}
