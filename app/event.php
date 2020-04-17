<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = [
        'event_title',
        'event_description',
        'event_date_start'
    ];
}
