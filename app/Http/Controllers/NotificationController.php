<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Notification;


class NotificationController extends Controller
{
    public function getNotification()
    {
        $notifications = Notification::where('receiver_id', Auth::user()->id )->get();
        return view('pages.notifications', compact('notifications'));
    }
}
