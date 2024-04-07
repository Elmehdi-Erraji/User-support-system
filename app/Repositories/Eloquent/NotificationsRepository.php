<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\NotificationsInterface;

class NotificationsRepository implements NotificationsInterface
{
    public function getUnreadNotificationsForUser($userId)
    {
        $user = User::findOrFail($userId);
        return $user->unreadNotifications;
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $notification->delete();
            return true;
        }
        return false;
    }

    public function markAllAsRead($userId)
    {
        $user = User::findOrFail($userId);
        $user->unreadNotifications->each(function ($notification) {
            $notification->markAsRead();
            $notification->delete();
        });
        return true;
    }
}
