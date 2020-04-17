<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'student_ID',
        'report_title',
        'report_description'
    ];
}
