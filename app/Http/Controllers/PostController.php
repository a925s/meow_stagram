<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;

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
        $posts = Post::where('status', 'active')->orderBy('created_at', 'desc')->get();
        $user_id = Auth::id();

        return view('main.home', [
            'posts' => $posts,
            'user_id' => $user_id,
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
     *  検索トップ表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getSearchPost(Request $request)
    {
        $posts = Post::where('status', 'active')->inRandomOrder()->get();
        $user_id = Auth::id();
        return view('main.search', [
            'posts' => $posts,
            'user_id' => $user_id,
        ]);
    }

    /**
     *  検索人気表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getSearchRankPost(Request $request)
    {
        $posts = Post::where('status', 'active')->withCount('likes')->where('status', 'active')->orderBy('likes_count', 'desc')->get(); // like-count順
        $user_id = Auth::id();
        return view('main.search_rank', [
            'posts' => $posts,
            'user_id' => $user_id,
        ]);
    }

    /**
     *  検索最新表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getSearchNewPost(Request $request)
    {
        $posts = Post::where('status', 'active')->orderBy('created_at', 'desc')->get();
        $user_id = Auth::id();
        return view('main.search_new', [
            'posts' => $posts,
            'user_id' => $user_id,
        ]);
    }

    /**
     *  検索動画表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getSearchVideoPost(Request $request)
    {
        $posts = Post::where('status', 'active')->orderBy('created_at', 'desc')->get();
        $user_id = Auth::id();
        return view('main.search_video', [
            'posts' => $posts,
            'user_id' => $user_id,
        ]);
    }
}
