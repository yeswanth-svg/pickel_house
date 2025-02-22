<?php

namespace App\Http\Controllers;

use App\Notifications\TicketMessageNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function getMessageNotifications()
    {
        $notifications = auth()->user()->notifications()
            ->where('type', TicketMessageNotification::class)
            ->latest()
            ->take(5)
            ->get();

        return response()->json($notifications);
    }

    public function getMessages()
    {
        // Fetch the latest 10 messages for the authenticated user
        $messages = auth()->user()->notifications()
            ->where('type', TicketMessageNotification::class)
            ->latest()
            ->take(10)
            ->get();

        // Mark all unread messages as read
        auth()->user()->unreadNotifications()
            ->where('type', TicketMessageNotification::class)
            ->update(['read_at' => now()]);

        return view('user.messages', compact('messages'));
    }

    public function getAdminMessages()
    {
        // Fetch the latest 10 messages for the authenticated user
        $messages = auth()->user()->notifications()
            ->where('type', TicketMessageNotification::class)
            ->latest()
            ->take(10)
            ->get();

        // Mark all unread messages as read
        auth()->user()->unreadNotifications()
            ->where('type', TicketMessageNotification::class)
            ->update(['read_at' => now()]);

        return view('admin.messages', compact('messages'));
    }


}
