<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'student_ID',
        'tutor_ID',
        'blog_title',
        'blog_content'
    ];
}
