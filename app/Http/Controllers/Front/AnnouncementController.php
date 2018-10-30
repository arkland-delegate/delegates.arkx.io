<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $announcements = Announcement::simplePaginate(5);

        return view('front.announcements.index', compact('announcements'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\View\View
     */
    public function search(Request $request): View
    {
        $announcements = Announcement::where(function ($query) use ($request) {
            $query
                ->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('body', 'like', '%'.$request->search.'%');
        })->simplePaginate(5);

        return view('front.announcements.index', compact('announcements'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Announcement $announcement
     *
     * @return \Illuminate\View\View
     */
    public function show(Announcement $announcement): View
    {
        return view('front.announcements.show', compact('announcement'));
    }
}
