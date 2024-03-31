<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TickesController extends Controller
{
    public function index()
    {
        $tickets = Ticket::withTrashed()->paginate(8);
        $statuses =  ['open', 'in_progress', 'on_hold', 'resolved', 'closed','wrong_category'];
        $priorities = ['low', 'medium', 'high'];

        $agents = User::whereHas('roles', function ($query) {
            $query->where('name', 'support_agent');
        })->get();

        return view('dashboard.admin.tickets.index',compact('tickets','statuses','priorities','agents'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.admin.tickets.create',compact('categories'));
    }

    public function store(Request $request)
    {
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
