<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waifuhashtagrelations extends Model
{
    //
    protected $table = 'Waifuhashtagrelations';
    protected $fillable = [
      'Waifu_id',
        'Hashtag_id',
    ];
}
