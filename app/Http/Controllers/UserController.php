<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     *  マイページ(post)表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getMypagePost(Request $request)
    {
        $user = Auth::user();
        $posts = $request->user()->posts()->where('status', 'active')->orderBy('created_at', 'desc')->get();
        $post_count = $posts->count();
        return view('main.mypage_post', [
            'user' => $user,
            'posts' => $posts,
            'post_count' => $post_count,
        ]);
    }

    /**
     *  マイページ(bookmark)表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getMypageBookmark(Request $request)
    {
        $user = Auth::user(); //ブックマーク登録
        $posts = $request->user()->posts()->where('status', 'active')->orderBy('created_at', 'desc')->get();
        $post_count = $posts->count();
        return view('main.mypage_bookmark', [
            'user' => $user,
            'posts' => $posts,
            'post_count' => $post_count,
        ]);
    }

    /**
     *  ユーザー編集
     * 
     *  @param Request $request
     *  @return Response
     */
    public function updateUser(Request $request)
    {
        $user = Auth::user();

        if($request->image){
            $request->validate([
                'image' => 'file|image'
            ]);
            $upload_image = $request->file('image');

            if($upload_image){
                $path = $upload_image->store('uploads', "public");
                if($path){
                    $user->image_name = $upload_image->getClientOriginalName();
                    $user->image_path = $path;
                }
            }
        }

        $user->nickname = $request->nickname;
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }
        $user->save();

        return back();
    }
}
