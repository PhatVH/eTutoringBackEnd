<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'staff_name',
        'staff_email',
        'staff_phone',
        'user_ID'
    ];
}
