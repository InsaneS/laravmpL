<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //
    protected $table = 'Posts';
    protected $fillable = [
      'previewIMG',
        'author_id',
        'fullIMG',
        'publishDate'
    ];
    
    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    } 
    public function hashtags()
    {
        return $this->belongsToMany('App\Hashtag', 'Relationposthashtags', 'Post_id', 'Hashtag_id');
    }
    public function waifus()
    {
        return $this->belongsToMany('App\waifu', 'Waifupostrelations', 'post_id', 'waifu_id');
    }
    public function userlike(){
        return $this->belongsToMany('App\User', 'Relationpostuserlikes', 'Post_id', 'User_id');
    }
}
