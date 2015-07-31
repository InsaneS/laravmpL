<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
     protected $fillable = [
      'name',
        'HashtagType_id',
        'url',
        'active'
    ];
    
    public function WaifusWithArchetype()
    {
        return $this->hasMany('App\waifu', 'Archetype');
    }
    public function waifus()
    {
        return $this->belongsToMany('App\waifu', 'Waifuhashtagrelations', 'Waifu_id', 'Hashtag_id');
    }
}
