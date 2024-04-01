<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalTickets = Ticket::count();
        $totalClients = User::whereHas('roles',function($query){
            $query->where('name','client');
        })->count();
        $totalAgents = User::whereHas('roles',function($query){
            $query->where('name','support_agent');
        })->count();

        $tickets = Ticket::all();

        $ticketStatuses = $tickets->groupBy('status')
        ->map(function ($group) {
            return $group->count();
        })->toArray();

        $ticketStatusesJson = json_encode(array_values($ticketStatuses));

        $ticketCreationDates = [];
        foreach ($tickets as $ticket) {
            $creationDate = Carbon::parse($ticket->created_at)->toDateString();

            if (!in_array($creationDate, $ticketCreationDates)) {
                $ticketCreationDates[] = $creationDate;
            }
        }

        $ticketsCreatedCount = [];
        foreach ($ticketCreationDates as $date) {
            $count = Ticket::whereDate('created_at', $date)->count();
            $ticketsCreatedCount[$date] = $count;
        }

        ksort($ticketsCreatedCount);

        $ticketCreationDatesJson = json_encode(array_values($ticketCreationDates)); 
        $ticketsCreatedCountJson = json_encode(array_values($ticketsCreatedCount)); 


        $ticketCounts = Ticket::groupBy('category_id')
        ->selectRaw('category_id, count(*) as count')
        ->pluck('count', 'category_id')
        ->toArray();

        $categoryIds = array_keys($ticketCounts);

        $categories = Category::whereIn('id', $categoryIds)->get()->toArray();

        $categoryNames = array_column($categories, 'name');

        $ticketCounts = array_values($ticketCounts);

        $categoriesJson = json_encode($categoryNames);
        $ticketCountsJson = json_encode($ticketCounts);

        $user = Auth::user();
        $unreadNotifications = $user->unreadNotifications;
        $notifications = $user->notifications;
        
        return view('dashboard.admin.dashboard', compact('totalUsers', 'totalTickets', 'totalClients', 'totalAgents', 'ticketStatusesJson', 'ticketCreationDatesJson', 'ticketsCreatedCountJson','categoriesJson','ticketCountsJson','notifications','unreadNotifications'));
    }
}
