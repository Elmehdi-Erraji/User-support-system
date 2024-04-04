<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificatoinsController extends Controller
{
   
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = $user->unreadNotifications;
        
        return response()->json(['notifications' => $notifications]);
    }

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $id = $request->input('id');
        $notification = $user->unreadNotifications->find($id);
        if ($notification) {
            $notification->markAsRead();
             $notification->delete();
            return redirect()->route('clinets_list'); 
        } else {
            return response()->json(['error' => 'Notification not found'], 404);
        }
    }

    public function markAsAllRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->each(function ($notification) {
            $notification->markAsRead();
            $notification->delete();
        });
    
        return redirect()->back();
    }
}
