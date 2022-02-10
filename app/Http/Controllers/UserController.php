<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Bookmark;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     *  マイページ表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getMypage(Request $request, $type)
    {
        $user = Auth::user();
        if($type == 'post'){
            $posts = $request->user()->posts()->where('status', 'active')->orderBy('created_at', 'desc')->get();
            $post_count = $posts->count();
        }elseif($type == 'bookmark'){
            $bookmarks = $request->user()->bookmarks()->where('status', 'active')->orderBy('created_at', 'desc')->get();
            $post_count = $request->user()->posts()->where('status', 'active')->count();
        }
        $follow_count = $user->follow()->where('status', 'active')->count();
        $followed_count = $user->followed()->where('status', 'active')->count();

        if($type == 'post'){
            return view('main.mypage', [
                'user' => $user,
                'posts' => $posts,
                'post_count' => $post_count,
                'follow_count' => $follow_count,
                'followed_count' => $followed_count,
                'type' => $type,
            ]);
        }elseif($type == 'bookmark'){
            return view('main.mypage', [
                'user' => $user,
                'bookmarks' => $bookmarks,
                'post_count' => $post_count,
                'follow_count' => $follow_count,
                'followed_count' => $followed_count,
                'type' => $type,
            ]);
        }
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

    /**
     *  他のユーザーページ表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getUserPage(Request $request, $id)
    {
        $user = User::find($id);
        $posts = $user->posts()->where('status', 'active')->orderBy('created_at', 'desc')->get();
        $post_count = $posts->count();
        $follow_count = $user->follow()->where('status', 'active')->count();
        $followed_count = $user->followed()->where('status', 'active')->count();
        return view('main.user', [
            'user' => $user,
            'posts' => $posts,
            'post_count' => $post_count,
            'follow_count' => $follow_count,
            'followed_count' => $followed_count,
            
        ]);
    }
}
