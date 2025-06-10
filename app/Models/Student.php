<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory;

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
}
