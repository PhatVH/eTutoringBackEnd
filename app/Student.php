<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_ID',
        'student_name',
        'student_email',
        'student_phone',
        'user_ID'
    ];

    public function tutors()
    {
        return $this->belongsTo(Tutor::class);
    }
}
