<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Ticket::withTrashed()->get();
        return view('dashboard.agent.tickets.index',compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.agent.tickets.create',compact('categories'));
    }

    public function store(Request $request)
    {
        echo 'agent';
        dd($request->all());
       $ticket = Ticket::create($request->all());
       return redirect()->route('ticket.index')->with('success','ticket created successfully');
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $categories = Category::all();
        return view('dashboard.admin.tickets.edit',compact('ticket','categories'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->update($request->all());
        return redirect()->route('ticket.index')->with('success','ticket updated successfully');
    }


    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('ticket.index')->with('success','ticket deleted successfully');
    }


    public function restore($id)
    {
        Ticket::withTrashed()->where('id', $id)->restore();
        return redirect()->route('ticket.index')->with('success', 'Ticket restored successfully.');
    }

    public function forceDelete($id)
    {
        Ticket::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('ticket.index')->with('success', 'Ticket permanently deleted.');
    }
}
