<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Ticket extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,LogsActivity,InteractsWithMedia;
    protected static $logAttributes = ['status', 'assigned_to', 'priority'];

    protected static $logName = 'ticket';

     protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'category_id',
        'department_id',
        'user_id',
        'agent_id',
     ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }
     public function agent()
     {
         return $this->belongsTo(User::class, 'agent_id');
     }

     public function category()
     {
         return $this->belongsTo(Category::class);
     }
     public function department()
     {
         return $this->belongsTo(Department::class);
     }
     public function supportAgent()
    {
        return $this->belongsTo(User::class, 'support_agent_id');
    }


    public function getDescriptionForEvent(string $eventName): string
    {
        $userName = auth()->user()->name;

        if ($eventName === 'updated') {
            return "Ticket '{$this->title}' was updated by {$userName}";
        } elseif ($eventName === 'deleted') {
            return "Ticket '{$this->title}' was deleted by {$userName}";
        }

        return "Ticket '{$this->title}' was {$eventName}";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
