<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    // 通知を送ったユーザー取得
    public function sent_user()
    {
        $sent_user = User::find($this->sent_user_id);
        return $sent_user;
    }
}
