<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;

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
        $like_id = $request->like_id;

        // post_idがPOSTされた場合（いいね！する）
        if(isset($post_id)){
            $like = new Like;
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();
        }
        // like_idがPOSTされた場合（いいね！外す）
        if(isset($like_id)){
            $like = Like::find($like_id);
            $like->status = 'delete';
            $like->save();
        }

        $param = [
            'message' => 'successful',
            'like_id' => $like_id,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
    }
}
