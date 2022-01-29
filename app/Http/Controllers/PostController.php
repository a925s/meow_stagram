<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     *  投稿する
     * 
     *  @param Request $request
     *  @return Response
     */
    public function post(Request $request)
    {
        //$this->validate($request, Post::$rules);
        //$post = new Post;
        //$post->user_id = 1;
        //$post->body = $request->body;
        //$post->save();

        dd($request->file('post_img'));
        //ファイルの保存
        $request->file('post_img')->storeAs('public/post_img', $post->id.'.'.$request->post_img->extension());
        
        return redirect('/home');
    }
}
