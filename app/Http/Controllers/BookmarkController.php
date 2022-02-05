<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Post;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
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
     *  ブックマークする、ブックマーク外す
     * 
     *  @param Request $request
     *  @return Response
     */
    public function bookmark(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;
        $bookmark_id = null;

        // post_idがPOSTされた場合（ブックマークする）
        if(isset($post_id)){
            $bookmark = new Bookmark;
            $bookmark->user_id = $user_id;
            $bookmark->post_id = $post_id;
            $bookmark->save();
            $bookmark_id = $bookmark->id;
        }
        // bookmark_idがPOSTされた場合（ブックマーク外す）
        if(isset($request->bookmark_id)){
            $bookmark = Bookmark::find($request->bookmark_id);
            $bookmark->status = 'delete';
            $bookmark->save();
        }

        $param = [
            'message' => 'successful',
            'bookmark_id' => $bookmark_id,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
    }
}
