<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
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
     *  通知表示
     * 
     *  @param Request $request
     *  @return Response
     */
    public function getNotification(Request $request)
    {
        $user_id = Auth::id();
        $notifications = Notification::where('sent_user_id', '!=', $user_id)->where('received_user_id', $user_id)->where('status', 'active')->orderBy('created_at', 'desc')->simplePaginate(10); 

        return view('main.notification', [
            'user_id' => $user_id,
            'notifications' => $notifications,
        ]);
    }
}
