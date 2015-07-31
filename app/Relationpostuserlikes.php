<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationpostuserlikes extends Model
{
    //
    protected $table = 'Relationpostuserlikes';
    protected $fillable = [
      'Post_id',
        'User_id',
    ];
}
