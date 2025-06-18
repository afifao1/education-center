<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject', 'exam_date', 'score'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function submissions()
{
    return $this->hasMany(Submission::class);
}
}
