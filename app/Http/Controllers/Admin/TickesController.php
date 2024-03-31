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

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $priority = $request->input('priority');
        $status = $request->input('status');
        $agent = $request->input('agent');

        $query = Ticket::query();

        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%');
            });
        }

        if (!empty($priority) && $status !== 'null') {
            $query->where('priority', $priority);
        }

        if (!empty($status) && $status !== 'null') {
            $query->where('status', $status);
        }

        if (!empty($agent) && $agent !== 'null') {
            $query->where('support_agent_id', $agent);
        }

        $query->withTrashed();

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
