<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
    * コンストラクタ
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  ホーム表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getHomePost(Request $request)
    {
        $user = Auth::user();
        $posts = Post::whereIn('user_id', $user->follow()->pluck('followed_user_id'))->orderBy('created_at', 'desc')->get();

        return view('main.home', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    /**
     *  投稿する
     * 
     *  @param Request $request
     *  @return Response
     */
    public function post(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post = new Post;
        $post->user_id = Auth::id();
        $post->body = $request->body;
        $post->save();

        //ファイルの保存
        if($request->post_img->extension() == 'gif' || $request->post_img->extension() == 'jpeg' || $request->post_img->extension() == 'jpg' || $request->post_img->extension() == 'png' || $request->post_img->extension() == 'mp4' || $request->post_img->extension() == 'mov' || $request->post_img->extension() == 'wmv'){
            $request->file('post_img')->storeAs('public/post_img', $post->id.'.'.$request->post_img->extension());
        }
        
        return back();
    }

    /**
     *  検索表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getSearchPost(Request $request, $type = null)
    {
        $user_id = Auth::id();
        $keyword = null;
        $keyword = $request->keyword;

        if($type == 'rank'){
            if(isset($keyword)){
                $user_ids = User::where('name', 'LIKE', "%{$keyword}%")->orWhere('nickname', 'LIKE', "%{$keyword}%")->pluck('id')->toArray();
                $posts = Post::whereIn('user_id', $user_ids)->where('status', 'active')->withCount('likes')->where('status', 'active')->orderBy('likes_count', 'desc')->get();
            }else{
                $posts = Post::where('status', 'active')->withCount('likes')->where('status', 'active')->orderBy('likes_count', 'desc')->get(); // like-count順
            }
        }elseif($type == 'new'){
            if(isset($keyword)){
                $user_ids = User::where('name', 'LIKE', "%{$keyword}%")->orWhere('nickname', 'LIKE', "%{$keyword}%")->pluck('id')->toArray();
                $posts = Post::whereIn('user_id', $user_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get();
            }else{
                $posts = Post::where('status', 'active')->orderBy('created_at', 'desc')->get(); // created_at順
            }
        }else{
            if(isset($keyword)){
                $user_ids = User::where('name', 'LIKE', "%{$keyword}%")->orWhere('nickname', 'LIKE', "%{$keyword}%")->pluck('id')->toArray();
                $posts = Post::whereIn('user_id', $user_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get();
            }else{
                $posts = Post::where('status', 'active')->inRandomOrder()->get(); // ランダム
            }
        }

        if(isset($keyword)){
            return view('main.search', [
                'posts' => $posts,
                'user_id' => $user_id,
                'type' => $type,
                'keyword' => $keyword,
            ]);
        }else{
            return view('main.search', [
                'posts' => $posts,
                'user_id' => $user_id,
                'type' => $type,
            ]);
        }
    }
}
