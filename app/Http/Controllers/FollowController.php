<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;

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
}
