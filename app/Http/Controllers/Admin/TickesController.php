<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TickesController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.tickets.index');
    }

    public function create()
    {
        return view('dashboard.admin.tickets.create');
    }
}
