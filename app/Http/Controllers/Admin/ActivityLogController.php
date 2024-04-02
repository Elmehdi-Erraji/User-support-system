<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        
        $logs = Activity::paginate(8);

        return view('dashboard.admin.activityLog.index', compact('logs'));
    }

    public function destroy($id)
    {
        $log = Activity::find($id);
        $log->delete();

        return redirect()->route('activity')->with('success', 'Log deleted successfully');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $event = $request->input('event');
    
        $query = Activity::query();
    
        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('description', 'like', '%' . $searchQuery . '%');
            });
        }
    
        if (!empty($event) && $event !== 'null') {
            $query->where('event', $event);
        }
    
        $logs = $query->get();
    
        $transformedLogs = $logs->map(function ($log) {
            $log['id'] = $log->id;
            $log['description'] = $log->description;
            $log['log_name'] = $log->log_name;
            $log['causer_name'] = $log->causer ? $log->causer->name : 'Unknown';
            $log['created_at'] = $log->created_at->format('Y-m-d H:i:s');
    
            return $log;
        });
    
        return response()->json($transformedLogs);
    }
    



}
