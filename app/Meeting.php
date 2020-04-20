<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'host',
        'start',
        'end',
        'title',
        'invite'
    ];
}
