<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'host_ID',
        'start',
        'end',
        'title',
        'invite_ID'
    ];
}
