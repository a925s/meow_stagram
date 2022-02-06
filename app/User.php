<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'nickname',
        'image_name',
        'image_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    // フォロワー
    public function followed()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_user_id', 'follow_user_id');
    }

    // フォロー
    public function follow()
    {
        return $this->belongsToMany('App\User', 'follows', 'follow_user_id', 'followed_user_id');
    }

    // data-follow-idの値
    public function follow_id() 
    {
        $user_id = Auth::id();
        $follow = Follow::where('status', 'active')->where('follow_user_id', $user_id)->where('followed_user_id', $this->id)->first();

        if(!empty($follow)){
            //レコードが存在するなら
            return $follow->id;
        }   
            //レコードが存在しなければnull
            return null;
    }
}
