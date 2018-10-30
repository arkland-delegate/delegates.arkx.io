<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of all notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->simplePaginate(5);

        return view('dashboard.notifications', compact('notifications'));
    }

    /**
     * Display a listing of read notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function read()
    {
        $notifications = auth()->user()->readNotifications()->simplePaginate(5);

        return view('dashboard.notifications', compact('notifications'));
    }

    /**
     * Display a listing of unread notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function unread()
    {
        $notifications = auth()->user()->unreadNotifications()->simplePaginate(5);

        return view('dashboard.notifications', compact('notifications'));
    }

    /**
     * Mark the given notifications as read.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request, string $notification)
    {
        $request->user()->notifications()->findOrFail($notification)->markAsRead();

        return response(null, 204);
    }
}
