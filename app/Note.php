<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'student_ID',
        'tutor_ID',
        'note_content'
    ];
}
