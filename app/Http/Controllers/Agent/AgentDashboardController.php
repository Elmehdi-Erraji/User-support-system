<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.agent.agent_dash');
    }
}
