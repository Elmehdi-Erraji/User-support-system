<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Contracts\DashboardInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {
        $totalUsers = $this->dashboardRepository->getTotalUsers();
        $totalTickets = $this->dashboardRepository->getTotalTickets();
        $totalClients = $this->dashboardRepository->getTotalClients();
        $totalAgents = $this->dashboardRepository->getTotalAgents();
        $ticketStatusesJson = $this->dashboardRepository->getTicketStatusesJson();
        $ticketCreationDatesJson = $this->dashboardRepository->getTicketCreationDatesJson();
        $ticketsCreatedCountJson = $this->dashboardRepository->getTicketsCreatedCountJson();
        $categoriesJson = $this->dashboardRepository->getCategoriesJson();
        $ticketCountsJson = $this->dashboardRepository->getTicketCountsJson();
        $notifications = Auth::user()->notifications;
        $unreadNotifications = Auth::user()->unreadNotifications;
        
        return view('dashboard.admin.dashboard', compact(
            'totalUsers', 
            'totalTickets', 
            'totalClients', 
            'totalAgents', 
            'ticketStatusesJson', 
            'ticketCreationDatesJson', 
            'ticketsCreatedCountJson', 
            'categoriesJson', 
            'ticketCountsJson', 
            'notifications', 
            'unreadNotifications'
        ));
    }
}
