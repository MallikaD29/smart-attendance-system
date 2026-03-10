<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attendance;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'employee_code',
        'department',
        'designation',
        'joining_date',
        'salary',
        'phone'
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
