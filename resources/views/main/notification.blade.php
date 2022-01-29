@extends('layout.app')

@section('title', '通知')

@section('main')
<div class="notifications-box">
    <div class="notification-box">
        <div class="icon">
            <img src="{{ asset('/img/like-red.png') }}" alt="ハートアイコン">
        </div>
        <div class="notification">
            <div class="users-icon">
                <div class="user-icon">
                    <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                </div>
                <div class="user-icon">
                    <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                </div>
                <div class="user-icon">
                    <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                </div>
                <div class="user-icon">
                    <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                </div>
                <div class="user-icon">
                    <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                </div>
            </div>
            <p><span>太郎</span>さんと他7人があなたの投稿にいいねしました</p>
            <p class="post">おはようございます。</p>
        </div>
    </div>
    <div class="notification-box">
        <div class="icon">
            <img src="{{ asset('/img/user.png') }}" alt="ユーザーアイコン">
        </div>
        <div class="notification">
            <div class="users-icon">
                <div class="user-icon">
                    <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
                </div>
            </div>
            <p><span>次郎</span>さんにフォローされました</p>
        </div>
    </div>
</div>
@endsection