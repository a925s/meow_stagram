<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\User;
use App\Image;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str; 

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
        $home_ids = $user->follow()->pluck('followed_user_id');
        $home_ids[] = $user->id;
        $posts = Post::whereIn('user_id', $home_ids)->orderBy('created_at', 'desc')->get();

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

        //ファイルの保存
        if($request->post_img->extension() == 'gif' || $request->post_img->extension() == 'jpeg' || $request->post_img->extension() == 'jpg' || $request->post_img->extension() == 'png'){
            $this->validate($request, Post::$rules);
            $post = new Post;
            $post->user_id = Auth::id();
            $post->body = $request->body;
            $post->save();

            $post_image = $request->file('post_img');
            $image_name = Str::random(20).'.'.$post_image->getClientOriginalExtension();
            \Image::make($post_image)->resize(500, null, function ($constraint) {$constraint->aspectRatio();})->save(public_path('storage/images/' . $image_name));
            
            $image = new Image;
            $image->image_path = 'images/' . $image_name;
            $image->post_id = $post->id;
            $image->save();

        }

        if($request->post_img->extension() == 'mp4' || $request->post_img->extension() == 'mov' || $request->post_img->extension() == 'wmv'){
            $this->validate($request, Post::$rules);
            $post = new Post;
            $post->user_id = Auth::id();
            $post->body = $request->body;
            $post->save();

            $path = $request->file('post_img')->store('images', "public");
            $image = new Image;
            $image->image_path = $path;
            $image->post_id = $post->id;
            $image->save();
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
