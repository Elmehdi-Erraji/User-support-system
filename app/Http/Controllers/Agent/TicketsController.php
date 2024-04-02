<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $tickets = Ticket::where('support_agent_id', $userId)->withTrashed()->get();
        $ticketsAssigned = Ticket::where('support_agent_id', $userId)->count();
        $ticketsResolved = Ticket::where('support_agent_id', $userId)
                             ->where('status', 'resolved')
                             ->count();

        $statuses =  ['open', 'in_progress', 'on_hold', 'resolved', 'closed','wrong_category'];
        $priorities = ['low', 'medium', 'high'];                 
        return view('dashboard.agent.tickets.index',compact('tickets','ticketsAssigned','ticketsResolved','statuses','priorities'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.agent.tickets.create',compact('categories'));
    }

    public function store(Request $request)
    {
       $ticket = Ticket::create($request->all());
       return redirect()->route('agent_ticket.index')->with('success','ticket created successfully');
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $categories = Category::all();
        $agents = User::whereHas('roles', function ($query) {
            $query->where('name', 'support_agent');
        })->get();
        return view('dashboard.agent.tickets.edit',compact('ticket','categories','agents'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        $ticket->status = $request->status;
        $ticket->priority = $request->priority;

        $originalStatus = $ticket->status;
        $originalPriority = $ticket->priority;

      
        if ($request->has('motif')) {
            $ticket->motif = $request->motif;
            $ticket->priority = 'low';
        }
        
        $ticket->save();

        if ($originalStatus !== $ticket->status || $originalPriority !== $ticket->priority) {
            $ticket->logActivity("Ticket '{$ticket->title}' was updated")->withLogName('ticket-update');
        }
        return redirect()->route('agent_ticket.index')->with('success','ticket updated successfully');
    }


    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticketTitle = $ticket->title;
        $ticket->delete();
        $ticket->logActivity("Ticket '{$ticketTitle}' was deleted")->withLogName('ticket-delete');
        return redirect()->route('agent_ticket.index')->with('success','ticket deleted successfully');
    }


    public function restore($id)
    {
        Ticket::withTrashed()->where('id', $id)->restore();
        return redirect()->route('agent_ticket.index')->with('success', 'Ticket restored successfully.');
    }

    public function forceDelete($id)
    {
        Ticket::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('agent_ticket.index')->with('success', 'Ticket permanently deleted.');
    }


    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $priority = $request->input('priority');
        $status = $request->input('status');

        $agentId = auth()->id();
        
        $query = Ticket::query();

        $query->where('support_agent_id', $agentId);
        
        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%');
            });
        }

        if (!empty($priority) && $priority !== 'null') {
            $query->where('priority', $priority);
        }

        if (!empty($status) && $status !== 'null') {
            $query->where('status', $status);
        }


        $tickets = $query->get();

        $transformedTickets = $tickets->map(function ($ticket) {
            $ticket['id'] = $ticket->id;
            $ticket['title'] = $ticket->title;
            $ticket['priority'] = $ticket->priority;
            $ticket['status'] = $ticket->status;
            $ticket['category'] = $ticket->category->name;
            $ticket['user'] = $ticket->user;
            $ticket['support_agent'] = $ticket->supportAgent;
            $ticket['created_at'] = $ticket->created_at->isoFormat('Do MMMM YYYY, h:mm:ssa') ;
            $ticket['updated_at'] = $ticket->updated_at->isoFormat('Do MMMM YYYY, h:mm:ssa') ;
            $ticket['updated_at'] = $ticket->updated_at->isoFormat('Do MMMM YYYY, h:mm:ssa') ;

            if( $ticket['deleted_at'] !== null){
                $ticket['updated_at'] = $ticket->deleted_at;
            }
            return $ticket;
        });

        return response()->json($transformedTickets);
    }
}
