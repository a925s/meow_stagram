<?php

namespace App\Http\Controllers;

use App\User;
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
        return view('main.mypage_post', [
            'user' => $user,
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
        return view('main.mypage_bookmark', [
            'user' => $user,
        ]);
    }
}
