<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    public function view(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }

    public function update(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }

    public function delete(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }

}
