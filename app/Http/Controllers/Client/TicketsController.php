<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
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
        $ticketData = $request->all();
    
        $category = Category::findOrFail($request->category_id);
    
        $ticketData['department_id'] = $category->department_id;
    
        $ticket = Ticket::create($ticketData);
    
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $media = $ticket->addMedia($file)->toMediaCollection('attachments', 'attachments');
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
    

    // private function assignAgentToTicket($categoryId)
    //     {
    //         $category = Category::findOrFail($categoryId);
    //         $department = $category->department;
    //         $agents = $department->agents()->pluck('id')->toArray(); 

    //         $totalAgents = count($agents);

    //         $totalTickets = Ticket::whereNotIn('status', ['closed', 'wrong_category'])->count();

    //         $ticketCounts = [];
    //         foreach ($agents as $agentId) {
    //             $ticketCounts[$agentId] = Ticket::where('support_agent_id', $agentId)
    //                 ->whereNotIn('status', ['closed', 'wrong_category'])
    //                 ->count();
    //         }

    //         $minTicketCount = min($ticketCounts);

    //         $agentsWithMinTickets = array_keys($ticketCounts, $minTicketCount);

    //         if (count($agentsWithMinTickets) == 1) {
    //             return User::find($agentsWithMinTickets[0]);
    //         } else {
    //             $randomAgentId = $agentsWithMinTickets[array_rand($agentsWithMinTickets)];
    //             return User::find($randomAgentId);
    //         }
    //     }


    private function assignAgentToTicket($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $department = $category->department;
        $agents = $department->agents()->where('status', '2')->pluck('id')->toArray();
    
        // Check if there are active agents in the department
        if (empty($agents)) {
            $ticketCounts = [];
            $allAgents = User::whereIn('id', Department::with('agents')->get()->pluck('agents.*.id')->flatten())->get();
    
            foreach ($allAgents as $agent) {
                $ticketCounts[$agent->id] = Ticket::where('support_agent_id', $agent->id)
                    ->whereNotIn('status', ['closed', 'wrong_category'])
                    ->count();
            }
    
            $minTicketCount = min($ticketCounts);
            $agentsWithMinTickets = array_keys($ticketCounts, $minTicketCount);
    
            if (count($agentsWithMinTickets) == 1) {
                return User::find($agentsWithMinTickets[0]);
            } else {
                $randomAgentId = $agentsWithMinTickets[array_rand($agentsWithMinTickets)];
                return User::find($randomAgentId);
            }
        }
    
        $ticketCounts = [];
        foreach ($agents as $agentId) {
            $ticketCounts[$agentId] = Ticket::where('support_agent_id', $agentId)
                ->whereNotIn('status', ['closed', 'wrong_category'])
                ->count();
        }
    
        $minTicketCount = min($ticketCounts);
    
        $agentsWithMinTickets = array_keys($ticketCounts, $minTicketCount);
    
        if (count($agentsWithMinTickets) == 1) {
            return User::find($agentsWithMinTickets[0]);
        } else {
            $randomAgentId = $agentsWithMinTickets[array_rand($agentsWithMinTickets)];
            return User::find($randomAgentId);
        }
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
