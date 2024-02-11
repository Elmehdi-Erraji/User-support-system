<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'description',
        'status',
        'profession',
        'phone',

    ];
    protected $attributes = [
        'status' => 0,
    ];

    const  STATUS_RADIO = [
        '0' => 'pinned',
        '1' => 'accepted',
        '2' => 'rejected',
    ];

    public function roles()
{
    return $this->belongsToMany(Role::class);
}
}
