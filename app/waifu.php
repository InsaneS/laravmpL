<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waifu extends Model
{
    //
    protected $table = 'waifus';
    protected $fillable = [
      'SmName',
        'author_id',
        'FullName',
        'Fiction_id',
        'FullImgUrl',
        'Archetype',
        'Rating',
        'WRating',
        'GRating',
        'Age',
        'Birthday',
        'VAtag'
    ];
    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }
    public function archetype(){
        return $this->belongsTo('App\Hashtag', 'Archetype');
    }
    public function fiction(){
        return $this->belongsTo('App\fiction', 'Fiction_id');
    } 
    public function hashtags()
    {
        return $this->belongsToMany('App\Hashtag', 'Waifuhashtagrelations', 'Waifu_id',  'Hashtag_id');
    }
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'Waifupostrelations', 'post_id', 'waifu_id');
    }
    public function age()
    {
        return $this->belongsTo('App\Hashtag', 'Age');
    }
    public function va()
    {
        return $this->belongsTo('App\Hashtag', 'VAtag');
    }
    public function birthday()
    {
        return $this->belongsTo('App\Hashtag', 'Birthday');
    }
}

