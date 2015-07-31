<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fiction extends Model
{
    //
    protected $fillable = [
      'name',
        'url',
        'FullImgUrl',
        'previewImgUrl',
        'active'
    ];
    public function authorwaifu()
    {
        return $this->hasMany('App\waifu', 'Fiction_id');
    }
}
