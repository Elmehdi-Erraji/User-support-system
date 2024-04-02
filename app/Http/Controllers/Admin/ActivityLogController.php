<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = DB::table('activity_log')
            ->select('activity_log.*', 'users.name as causer_name')
            ->leftJoin('users', 'activity_log.causer_id', '=', 'users.id')
            ->paginate(8);

        return view('dashboard.admin.activityLog.index', compact('logs'));
    }


}
