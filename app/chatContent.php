<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chatContent extends Model
{
    protected $fillable = [
        'chat_ID',
        'sender',
        'content'
    ];

    public function chats(){
        return $this->belongsTo(Chat::class);
    }
}
