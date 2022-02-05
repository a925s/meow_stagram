<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
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
     *  フォローする、フォロー外す
     * 
     *  @param Request $request
     *  @return Response
     */
    public function follow(Request $request)
    {
        $follow_user_id = Auth::id();
        $followed_user_id = $request->followed_user_id;
        $follow_id = null;

        // followed_user_idがPOSTされた場合（フォローする）
        if(isset($followed_user_id)){
            $follow = new Follow;
            $follow->follow_user_id = $follow_user_id;
            $follow->followed_user_id = $followed_user_id;
            $follow->save();
            $follow_id = $follow->id;
        }
        // follow_idがPOSTされた場合（フォロー外す）
        if(isset($request->follow_id)){
            $follow = Follow::find($request->follow_id);
            $follow->status = 'delete';
            $follow->save();
        }

        $param = [
            'message' => 'successful',
            'follow_id' => $follow_id,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
    }
}
