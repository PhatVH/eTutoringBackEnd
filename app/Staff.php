<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'authorisedStaff_name',
        'authorisedStaff_email',
        'authorisedStaff_phone'
    ];
}
