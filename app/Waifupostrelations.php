<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waifupostrelations extends Model
{
    //
    protected $table = 'Waifupostrelations';
    protected $fillable = [
      'post_id',
        'waifu_id',
    ];
}
