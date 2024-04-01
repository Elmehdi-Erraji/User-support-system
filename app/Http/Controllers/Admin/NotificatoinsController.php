<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificatoinsController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $unreadNotifications = $user->unreadNotifications;
        $notifications = $user->notifications;

        $name = $user->name;

        return view('dashboard.admin.dashboard', compact('notifications', 'unreadNotifications','name'));
    }   

    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->unreadNotifications->find($id);
        $notification->markAsRead();
        return redirect()->back();
    }

    public function markAllAsRead($id)
    {
        $user = Auth::user();
        $user->unreadNotifications->each(function ($notification) {
            $notification->markAsRead();
        });
    
        return redirect()->back();
    }
}
