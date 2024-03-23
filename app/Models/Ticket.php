<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

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
}
