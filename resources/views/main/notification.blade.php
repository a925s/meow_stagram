@extends('layout.app')

@section('title', '通知')

@section('main')
<div class="notifications-box">
    @if($notifications->isEmpty())
        <p class="p-3">通知がありません。</p>
    @else
        @foreach($notifications as $notification)
            @if($notification->post_id == null)
            <div class="notification-box">
                <div class="icon">
                    <img src="{{ asset('/img/user.png') }}" alt="ユーザーアイコン">
                </div>
                <div class="notification">
                    <div class="users-icon">
                        <div class="user-icon">
                            @if(isset($notification->sent_user()->image_path))
                            <a href="/user/{{ $notification->sent_user()->id }}"><img src="{{ Storage::url($notification->sent_user()->image_path) }}" alt="マイアイコン"></a>
                            @else
                            <a href="/user/{{ $notification->sent_user()->id }}"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                            @endif
                        </div>
                    </div>
                    <p><span>{{ $notification->sent_user()->nickname }}</span>さんにフォローされました</p>
                </div>
            </div>
            @else
            <div class="notification-box">
                <div class="icon">
                    <img src="{{ asset('/img/like-red.png') }}" alt="ハートアイコン">
                </div>
                <div class="notification">
                    <div class="users-icon">
                        <div class="user-icon">
                            @if(isset($notification->sent_user()->image_path))
                            <a href="/user/{{ $notification->sent_user()->id }}"><img src="{{ Storage::url($notification->sent_user()->image_path) }}" alt="マイアイコン"></a>
                            @else
                            <a href="/user/{{ $notification->sent_user()->id }}"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                            @endif
                        </div>
                    </div>
                    <p><span>{{ $notification->sent_user()->nickname }}</span>さんがあなたの投稿にいいねしました</p>
                    <p class="post">{{ $notification->post->body }}</p>
                </div>
            </div>
            @endif
        @endforeach
    @endif
</div>
@endsection