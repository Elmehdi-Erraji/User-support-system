<?php

namespace App\Repositories\Contracts;

interface NotificationsInterface
{
    public function getUnreadNotificationsForUser($userId);

    public function markAsRead($notificationId);

    public function markAllAsRead($userId);
}
