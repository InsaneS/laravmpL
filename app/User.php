<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{ 
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'AvatarUrl'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public function role(){
        return $this->belongsTo('App\userrole', 'Role_id');
    }
    
    public function postlike(){
        return $this->belongsToMany('App\Post', 'Relationpostuserlikes', 'User_id', 'Post_id');
    }
    public function waifulike(){
        return $this->belongsToMany('App\waifu', 'waifuuserrelations', 'User_id', 'Waifu_id');
    }
    public function authorposts()
    {
        return $this->hasMany('App\Post', 'author_id');
    }
    public function authorwaifu()
    {
        return $this->hasMany('App\waifu', 'author_id');
    }
}
