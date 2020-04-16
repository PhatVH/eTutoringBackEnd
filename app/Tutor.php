<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'tutor_name',
        'tutor_phone',
        'tutor_email'
    ];
}
