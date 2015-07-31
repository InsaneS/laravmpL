<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationposthashtags extends Model
{
    //
    protected $table = 'Relationposthashtags';
    protected $fillable = [
      'Post_id',
        'Hashtag_id',
    ];
}
