<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)->get();
        return view('dashboard.client.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.client.tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $ticket = Ticket::create($request->all());
        return redirect()->route('client_ticket.index')->with('success', 'Ticket created successfully');
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $categories = Category::all();
        return view('dashboard.client.tickets.edit', compact('ticket', 'categories'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $ticket->update($request->all());
        return redirect()->route('client_ticket.index')->with('success', 'Ticket updated successfully');
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully');
    }

    public function restore(Ticket $ticket)
    {
        $this->authorize('restore', $ticket);
        $ticket->restore();
        return redirect()->route('ticket.index')->with('success', 'Ticket restored successfully.');
    }

    public function forceDelete(Ticket $ticket)
    {
        $this->authorize('forceDelete', $ticket);
        $ticket->forceDelete();
        return redirect()->route('ticket.index')->with('success', 'Ticket permanently deleted.');
    }
}
