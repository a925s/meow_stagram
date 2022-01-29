@extends('layout.app')

@section('title', 'ホーム')

@section('main')
<div class="posts-box">
    <div class="post-box">
        <div class="name">
            <div class="post-my-icon">
                <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
            </div>
            <div class="post-my-name">
                <a href="#">
                    <span class="nickname">太郎</span>
                    <span class="user-name">@taro</span>
                </a>
            </div>
        </div>
        <div class="photo">
            <div class="photo-box">
                <img src="{{ asset('/img/post1.jpg') }}" alt="投稿写真">
            </div>
        </div>
        <div class="photo-bottom-icon">
            <div class="photo-icon">
                <img src="{{ asset('/img/like.png') }}" alt="いいね！アイコン">
            </div>
            <div class="photo-icon">
                <img src="{{ asset('/img/send.png') }}" alt="メッセージアイコン">
            </div>
            <div class="photo-bookmark-icon">
                <img src="{{ asset('/img/bookmark.svg') }}" alt="ブックマークアイコン">
            </div>
        </div>
        <div class="text-box">
            <p class="like-count">いいね！10件</p>
            <p>おはようございます。</p>
            <p class="post-date">21時間前</p>
        </div>
    </div>
    <div class="post-box">
        <div class="name">
            <div class="post-my-icon">
                <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
            </div>
            <div class="post-my-name">
                <a href="#">
                    <span class="nickname">次郎</span>
                    <span class="user-name">@jiro</span>
                </a>
            </div>
        </div>
        <div class="photo">
            <div class="photo-box">
                <img src="{{ asset('/img/post2.jpg') }}" alt="投稿写真">
            </div>
        </div>
        <div class="photo-bottom-icon">
            <div class="photo-icon">
                <img src="{{ asset('/img/like-red.png') }}" alt="いいね！アイコン">
            </div>
            <div class="photo-icon">
                <img src="{{ asset('/img/send.png') }}" alt="メッセージアイコン">
            </div>
            <div class="photo-bookmark-icon">
                <img src="{{ asset('/img/bookmark.svg') }}" alt="ブックマークアイコン">
            </div>
        </div>
        <div class="text-box">
            <p class="like-count">いいね！20件</p>
            <p>こんにちは。</p>
            <p class="post-date">1日前</p>
        </div>
    </div>
    <div class="post-box">
        <div class="name">
            <div class="post-my-icon">
                <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
            </div>
            <div class="post-my-name">
                <a href="#">
                    <span class="nickname">三郎</span>
                    <span class="user-name">@saburo</span>
                </a>
            </div>
        </div>
        <div class="photo">
            <div class="photo-box">
                <video src="{{ asset('/img/cat-video.mp4') }}" autoplay loop playsinline></video>
            </div>
        </div>
        <div class="photo-bottom-icon">
            <div class="photo-icon">
                <img src="{{ asset('/img/like-red.png') }}" alt="いいね！アイコン">
            </div>
            <div class="photo-icon">
                <img src="{{ asset('/img/send.png') }}" alt="メッセージアイコン">
            </div>
            <div class="photo-bookmark-icon">
                <img src="{{ asset('/img/bookmark.svg') }}" alt="ブックマークアイコン">
            </div>
        </div>
        <div class="text-box">
            <p class="like-count">いいね！25件</p>
            <p>こんにちは。</p>
            <p class="post-date">4日前</p>
        </div>
    </div>
</div>
@endsection