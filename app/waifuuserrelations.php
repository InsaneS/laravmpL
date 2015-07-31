<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class waifuuserrelations extends Model
{
    //
    protected $table = 'waifuuserrelations';
    protected $fillable = [
      'Waifu_id',
        'User_id',
        'RelationType_id'
    ];
}
