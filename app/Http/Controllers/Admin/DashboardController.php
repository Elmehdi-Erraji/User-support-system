<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

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



    
        return view('dashboard.admin.dashboard', compact('totalUsers', 'totalTickets', 'totalClients', 'totalAgents', 'ticketStatusesJson'));
    }
}
