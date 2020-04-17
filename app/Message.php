<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'tutor_ID',
        'student_ID',
        'message_content'
    ];
}
