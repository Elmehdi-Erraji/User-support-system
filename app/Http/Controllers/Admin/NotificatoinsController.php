<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\NotificationsInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificatoinsController extends Controller
{
    protected $notificationsRepo;

    public function __construct(NotificationsInterface $notificationsRepo)
    {
        $this->notificationsRepo = $notificationsRepo;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = $this->notificationsRepo->getUnreadNotificationsForUser($user->id);
        return response()->json(['notifications' => $notifications]);
    }

    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('id');
        $success = $this->notificationsRepo->markAsRead($notificationId);
        if ($success) {
            return redirect()->route('clients_list');
        } else {
            return response()->json(['error' => 'Notification not found'], 404);
        }
    }

    public function markAsAllRead()
    {
        $user = auth()->user();
        $this->notificationsRepo->markAllAsRead($user->id);
        return redirect()->back();
    }
}
