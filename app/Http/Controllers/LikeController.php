<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use App\Notification;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
     *  いいね！する、いいね！外す
     * 
     *  @param Request $request
     *  @return Response
     */
    public function like(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;
        $like_id = null;

        // post_idがPOSTされた場合（いいね！する）
        if(isset($post_id)){
            $like = new Like;
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();
            $like_id = $like->id;

            $post_user = Post::find($post_id);
            $post_user_id = $post_user->id;

            $notification = new Notification;
            $notification->received_user_id = $post_user_id;
            $notification->sent_user_id = $user_id;
            $notification->post_id = $post_id;
            $notification->save();
        }
        // like_idがPOSTされた場合（いいね！外す）
        if(isset($request->like_id)){
            $like = Like::find($request->like_id);
            $like->status = 'delete';
            $like->save();

            $user_id = $like->user_id;
            $post_id = $like->post_id;
            $post_user = Post::find($post_id);
            $post_user_id = $post_user->id;

            $notification = Notification::where('status', 'active')->where('received_user_id', $post_user_id)->where('sent_user_id', $user_id)->where('post_id', $post_id)->first();
            $notification->status = 'delete';
            $notification->save();
        }

        $param = [
            'message' => 'successful',
            'like_id' => $like_id,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
    }
}
