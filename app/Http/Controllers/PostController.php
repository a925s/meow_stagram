<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     *  ホーム表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getHomePost(Request $request)
    {
        $posts = Post::where('status', 'active')->orderBy('created_at', 'desc')->get();
        return view('main.home', [
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
        $post->user_id = 1;
        $post->body = $request->body;
        $post->save();

        //ファイルの保存
        if($request->post_img->extension() == 'gif' || $request->post_img->extension() == 'jpeg' || $request->post_img->extension() == 'jpg' || $request->post_img->extension() == 'png' || $request->post_img->extension() == 'mp4' || $request->post_img->extension() == 'mov' || $request->post_img->extension() == 'wmv'){
            $request->file('post_img')->storeAs('public/post_img', $post->id.'.'.$request->post_img->extension());
        }
        
        return back();
    }
}
