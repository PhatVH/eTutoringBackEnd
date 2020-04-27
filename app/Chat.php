<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'tutor_user_id',
        'student_user_id'
    ];

    public function chatContents(){
        return $this->hasMany(chatContent::class);
    }
}
