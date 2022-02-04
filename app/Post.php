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
    public function post_like_id() {
        $user_id = Auth::id();
        $post_like = Like::where('user_id', $user_id)->where('post_id', $this->id)->first();

        if(isset($post_like)){
            //レコード（$like_id）が存在するなら
            return $post_like->id;
        }else{
            //レコード（$like_id）が存在しないなら
            return null;
        }
    }

    // like-countの値
    public function like_count(){
        $like_count = Like::where('status', 'active')->where('post_id', $this->id)->count();

        return $like_count;
    }
}
