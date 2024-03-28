<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        // Extract the creation date and format it to 'Y-m-d' (Year-Month-Day) format
        $creationDate = Carbon::parse($ticket->created_at)->toDateString();

        // Check if the creation date is already present in the array
        // If not, add it to the array
        if (!in_array($creationDate, $ticketCreationDates)) {
            $ticketCreationDates[] = $creationDate;
        }
    }

    // Count the number of tickets created for each unique date
    $ticketsCreatedCount = [];
    foreach ($ticketCreationDates as $date) {
        // Count the number of tickets created on the current date
        $count = Ticket::whereDate('created_at', $date)->count();

        // Store the count in the $ticketsCreatedCount array with the date as key
        $ticketsCreatedCount[$date] = $count;
    }

    // Sort the array by keys (dates) in ascending order
    ksort($ticketsCreatedCount);

    // Convert arrays to JSON for passing to JavaScript
    $ticketCreationDatesJson = json_encode(array_values($ticketCreationDates)); // Only values without keys
    $ticketsCreatedCountJson = json_encode(array_values($ticketsCreatedCount)); // Only values without keys


    $ticketCounts = Ticket::groupBy('category_id')
    ->selectRaw('category_id, count(*) as count')
    ->pluck('count', 'category_id')
    ->toArray();

// Get the categories that have at least one ticket associated with them
$categoryIds = array_keys($ticketCounts);

// Retrieve the category names for the categories that have tickets
$categories = Category::whereIn('id', $categoryIds)->get()->toArray();

// Extract only the category names from the $categories array
$categoryNames = array_column($categories, 'name');

// Extract the ticket counts for the corresponding categories
$ticketCounts = array_values($ticketCounts);

// Convert arrays to JSON for passing to JavaScript
$categoriesJson = json_encode($categoryNames);
$ticketCountsJson = json_encode($ticketCounts);

    
    return view('dashboard.admin.dashboard', compact('totalUsers', 'totalTickets', 'totalClients', 'totalAgents', 'ticketStatusesJson', 'ticketCreationDatesJson', 'ticketsCreatedCountJson','categoriesJson','ticketCountsJson'));
}
}
