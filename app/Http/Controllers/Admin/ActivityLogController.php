<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ActivityLogInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    protected $activityLogRepo;

    public function __construct(ActivityLogInterface $activityLogRepo)
    {
        $this->activityLogRepo = $activityLogRepo;
    }

    public function index()
    {
        $logs = $this->activityLogRepo->paginate(8);
        return view('dashboard.admin.activityLog.index', compact('logs'));
    }

    public function destroy($id)
    {
        $this->activityLogRepo->delete($id);
        return redirect()->route('activity')->with('success', 'Log deleted successfully');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $event = $request->input('event');

        $logs = $this->activityLogRepo->searchLogs($searchQuery, $event);

        $transformedLogs = $logs->map(function ($log) {
            return [
                'id' => $log->id,
                'description' => $log->description,
                'log_name' => $log->log_name,
                'causer_name' => $log->causer ? $log->causer->name : 'Unknown',
                'created_at' => $log->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json($transformedLogs);
    }
}
