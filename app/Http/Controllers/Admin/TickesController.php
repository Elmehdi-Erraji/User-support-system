<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Contracts\TicketsInterface;
use Illuminate\Http\Request;

class TickesController extends Controller
{
    protected $ticketRepo;

    public function __construct(TicketsInterface $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }

    public function index()
    {
        $tickets = $this->ticketRepo->paginate(8);
        $statuses = ['open', 'in_progress', 'on_hold', 'resolved', 'closed', 'wrong_category'];
        $priorities = ['low', 'medium', 'high'];
        $agents = User::whereHas('roles', function ($query) {
            $query->where('name', 'support_agent');
        })->get();

        return view('dashboard.admin.tickets.index', compact('tickets', 'statuses', 'priorities', 'agents'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.admin.tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $ticket = Ticket::create($request->all());
    
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $media = $ticket->addMedia($file)->toMediaCollection('attachments');
            }
        }
    
        $agent = $this->assignAgentToTicket($request->category_id);
    
        if (!$agent) {
            return redirect()->route('client_ticket.index')->with('error', 'No available agents to assign the ticket');
        }
    
        $ticket->support_agent_id = $agent->id;
        $ticket->save();
    
        return redirect()->route('client_ticket.index')->with('success', 'Ticket created successfully');
    }


    public function edit($id)
    {
        $ticket = $this->ticketRepo->findById($id);
        $categories = Category::all();
        return view('dashboard.admin.tickets.edit', compact('ticket', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->ticketRepo->update($id, $request->all());
        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully');
    }

    public function destroy($id)
    {
        $this->ticketRepo->delete($id);
        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully');
    }

    public function restore($id)
    {
        $this->ticketRepo->restore($id);
        return redirect()->route('ticket.index')->with('success', 'Ticket restored successfully');
    }

    public function forceDelete($id)
    {
        $this->ticketRepo->forceDelete($id);
        return redirect()->route('ticket.index')->with('success', 'Ticket permanently deleted');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $priority = $request->input('priority');
        $status = $request->input('status');
        $agent = $request->input('agent');

        $tickets = $this->ticketRepo->searchTickets($searchQuery, $priority, $status, $agent);

        $transformedTickets = $tickets->map(function ($ticket) {
            $ticket['id'] = $ticket->id;
            $ticket['title'] = $ticket->title;
            $ticket['priority'] = $ticket->priority;
            $ticket['status'] = $ticket->status;
            $ticket['category'] = $ticket->category->name;
            $ticket['user'] = $ticket->user;
            $ticket['support_agent'] = $ticket->supportAgent;
            $ticket['created_at'] = $ticket->created_at->isoFormat('Do MMMM YYYY, h:mm:ssa');
            $ticket['updated_at'] = $ticket->updated_at->isoFormat('Do MMMM YYYY, h:mm:ssa');
            $ticket['updated_at'] = $ticket->updated_at->isoFormat('Do MMMM YYYY, h:mm:ssa');

            if ($ticket['deleted_at'] !== null) {
                $ticket['updated_at'] = $ticket->deleted_at;
            }
            return $ticket;
        });

        return response()->json($transformedTickets);
    }
}
