<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingNote extends Model
{
    protected $fillable = [
        'meeting_ID',
        'user_ID',
        'content'
    ];
}
