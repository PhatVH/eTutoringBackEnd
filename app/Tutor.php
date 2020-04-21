<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'tutor_name',
        'tutor_phone',
        'tutor_email',
        'user_ID'
    ];

    public function students(){
        return $this->hasMany(Student::class);
    }
}
