<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'examination_id',
        'student_id',
        'content',
        'file_path',
        'score',
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
