<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'parent_phone',
        'password',
        'group_id',
        'teacher_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function latestAttendance()
    {
        return $this->hasOne(Attendance::class)->latestOfMany();
    }

}
