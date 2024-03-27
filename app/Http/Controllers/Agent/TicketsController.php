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
        return view('dashboard.agent.tickets.index',compact('tickets'));
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
      
        if ($request->has('motif')) {
            $ticket->motif = $request->motif;
            $ticket->priority = 'low';
        }
        
        $ticket->save();
        return redirect()->route('agent_ticket.index')->with('success','ticket updated successfully');
    }


    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
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
}
