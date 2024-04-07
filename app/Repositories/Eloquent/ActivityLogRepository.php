<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ActivityLogInterface;
use Spatie\Activitylog\Models\Activity ;

class ActivityLogRepository implements ActivityLogInterface
{
    public function all()
    {
        return Activity::all();
    }

    public function paginate($perPage)
    {
        return Activity::paginate($perPage);
    }

    public function findById($id)
    {
        return Activity::findOrFail($id);
    }

    public function delete($id)
    {
        $log = Activity::findOrFail($id);
        $log->delete();
    }

    public function searchLogs($searchQuery, $event)
    {
        $query = Activity::query();

        if (!empty($searchQuery)) {
            $query->where('description', 'like', '%' . $searchQuery . '%');
        }

        if (!empty($event) && $event !== 'null') {
            $query->where('event', $event);
        }

        return $query->get();
    }
}
