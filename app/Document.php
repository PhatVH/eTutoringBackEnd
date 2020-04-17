<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'student_ID',
        'tutor_ID',
        'document_name'
    ];
}
