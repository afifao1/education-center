<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['student_id', 'payment_date', 'amount', 'payment_method'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
