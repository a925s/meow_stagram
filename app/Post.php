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

    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
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

    // data-bookmark-idの値
    public function post_bookmark_id() 
    {
        $user_id = Auth::id();
        $post_bookmark = Bookmark::where('status', 'active')->where('user_id', $user_id)->where('post_id', $this->id)->first();

        if(!empty($post_bookmark)){
            //レコードが存在するなら
            return $post_bookmark->id;
        }   
            //レコードが存在しなければnull
            return null;
    }

    // 投稿ユーザーの投稿カウント
    public function post_count(){
        $user = User::find($this->user_id);
        $post_count = $user->posts()->where('status', 'active')->orderBy('created_at', 'desc')->count();
        return $post_count;
    }

    // 投稿ユーザーのフォローカウント
    public function follow_count(){
        $user = User::find($this->user_id);
        $follow_count = $user->follow()->where('status', 'active')->count();
        return $follow_count;
    }

    // 投稿ユーザーのフォロワーカウント
    public function followed_count(){
        $user = User::find($this->user_id);
        $followed_count = $user->followed()->where('status', 'active')->count();
        return $followed_count;
    }
}
