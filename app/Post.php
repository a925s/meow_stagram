<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        'body',
    ];

    public static $rules = [
        'body' => 'required|max:200'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    // data-like-idの値
    public function post_like_id() 
    {
        $user_id = Auth::id();
        $post_like = Like::where('status', 'active')->where('user_id', $user_id)->where('post_id', $this->id)->first();

        if(!empty($post_like)){
            //レコードが存在するなら
            return $post_like->id;
        }   
            //レコードが存在しなければnull
            return null;
    }

    // like-countの値
    public function like_count(){
        $like_count = Like::where('status', 'active')->where('post_id', $this->id)->count();

        return $like_count;
    }
}
