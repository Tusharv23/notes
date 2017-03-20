<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    //
     protected $fillable = [
        'name', 'artist', 'genre',
    ];
}
