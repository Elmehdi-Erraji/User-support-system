<?php 


namespace App\Repositories\Contracts;

interface DashboardInterface
{
    public function getTotalUsers();

    public function getTotalTickets();

    public function getTotalClients();

    public function getTotalAgents();

    public function getTicketStatusesJson();

    public function getTicketCreationDatesJson();

    public function getTicketsCreatedCountJson();

    public function getCategoriesJson();

    public function getTicketCountsJson();
}
