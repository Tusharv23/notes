<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'text', 'sender_username', 'receiver_username','read',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message';
}
