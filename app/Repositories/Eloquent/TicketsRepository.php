<?php

namespace App\Repositories\Eloquent;

use App\Models\Ticket;
use App\Repositories\Contracts\TicketsInterface;

class TicketsRepository implements TicketsInterface
{
    public function all()
    {
        return Ticket::withTrashed()->get();
    }

    public function paginate($perPage)
    {
        return Ticket::paginate($perPage);
    }

    public function findById($id)
    {
        return Ticket::findOrFail($id);
    }

    public function create($data)
    {
        return Ticket::create($data);
    }

    public function update($id, $data)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($data);
    }

    public function delete($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }

    public function restore($id)
    {
        Ticket::withTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        Ticket::withTrashed()->where('id', $id)->forceDelete();
    }

    public function searchTickets($searchQuery, $priority, $status, $agent)
    {
        $query = Ticket::query();

        if (!empty($searchQuery)) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }

        if (!empty($priority) && $priority !== 'null') {
            $query->where('priority', $priority);
        }

        if (!empty($status) && $status !== 'null') {
            $query->where('status', $status);
        }

        if (!empty($agent) && $agent !== 'null') {
            $query->where('support_agent_id', $agent);
        }

        return $query->withTrashed()->get();
    }
}
