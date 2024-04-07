<?php 

namespace App\Repositories\Eloquent;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Carbon;
use App\Repositories\Contracts\DashboardInterface;

class DashboardRepository implements DashboardInterface
{
    public function getTotalUsers()
    {
        return User::count();
    }

    public function getTotalTickets()
    {
        return Ticket::count();
    }

    public function getTotalClients()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();
    }

    public function getTotalAgents()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'support_agent');
        })->count();
    }

    public function getTicketStatusesJson()
    {
        $tickets = Ticket::all();

        $ticketStatuses = $tickets->groupBy('status')
            ->map(function ($group) {
                return $group->count();
            })->toArray();

        return json_encode(array_values($ticketStatuses));
    }

    public function getTicketCreationDatesJson()
    {
        $tickets = Ticket::all();
        $ticketCreationDates = [];

        foreach ($tickets as $ticket) {
            $creationDate = Carbon::parse($ticket->created_at)->toDateString();

            if (!in_array($creationDate, $ticketCreationDates)) {
                $ticketCreationDates[] = $creationDate;
            }
        }

        ksort($ticketCreationDates);

        return json_encode(array_values($ticketCreationDates));
    }

    public function getTicketsCreatedCountJson()
    {
        $tickets = Ticket::all();
        $ticketCreationDates = [];

        foreach ($tickets as $ticket) {
            $creationDate = Carbon::parse($ticket->created_at)->toDateString();

            if (!isset($ticketCreationDates[$creationDate])) {
                $ticketCreationDates[$creationDate] = 1;
            } else {
                $ticketCreationDates[$creationDate]++;
            }
        }

        ksort($ticketCreationDates);

        return json_encode(array_values($ticketCreationDates));
    }

    public function getCategoriesJson()
    {
        $ticketCounts = Ticket::groupBy('category_id')
            ->selectRaw('category_id, count(*) as count')
            ->pluck('count', 'category_id')
            ->toArray();

        $categoryIds = array_keys($ticketCounts);

        $categories = Category::whereIn('id', $categoryIds)->get()->toArray();

        $categoryNames = array_column($categories, 'name');

        return json_encode($categoryNames);
    }

    public function getTicketCountsJson()
    {
        $ticketCounts = Ticket::groupBy('category_id')
            ->selectRaw('category_id, count(*) as count')
            ->pluck('count', 'category_id')
            ->toArray();

        return json_encode(array_values($ticketCounts));
    }
}
