<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)->get();
        $openTickets = Ticket::where('user_id', $user->id)->where('status', 'open')->count();
        $resolvedTickets = Ticket::where('user_id', $user->id)->where('status', 'resolved')->count();
        return view('dashboard.client.tickets.index', compact('tickets','openTickets','resolvedTickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        $user = Auth::user();
        return view('dashboard.client.tickets.show', compact('ticket','user'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.client.tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $ticket = Ticket::create($request->all());
    
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $media = $ticket->addMedia($file)->toMediaCollection('attachments');
            }
        }
        
        $category = Category::find($request->category_id);
        $department = $category->department;
        $agents = $department->agents;
    
        if ($agents->count() > 0) {
            $agent = $agents->random();
            $ticket->support_agent_id = $agent->id;
        } else {
            $availableAgents = User::whereHas('roles', function ($query) {
                $query->where('name', 'support_agent');
            })->get();
    
            if ($availableAgents->count() > 0) {
                $agent = $availableAgents->random();
                $ticket->support_agent_id = $agent->id;
            } else {
                return redirect()->route('client_ticket.index')->with('error', 'No available agents to assign the ticket');
            }
        }
    
        $ticket->save();
    
        return redirect()->route('client_ticket.index')->with('success', 'Ticket created successfully');
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $categories = Category::all();
        return view('dashboard.client.tickets.edit',compact('ticket','categories'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if ($ticket->status === 'wrong_category' && $request->has('category_id')) {
            $ticket->status = 'open';
            $ticket->motif = Null;
        }
        $ticket->update($request->all());
        return redirect()->route('client_ticket.index')->with('success','ticket updated successfully');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('client_ticket.index')->with('success','ticket deleted successfully');
    }

    public function restore($id)
    {
        Ticket::withTrashed()->where('id', $id)->restore();
        return redirect()->route('client_ticket.index')->with('success', 'Ticket restored successfully.');
    }

    public function forceDelete($id)
    {
        Ticket::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('client_ticket.index')->with('success', 'Ticket permanently deleted.');
    }
}
