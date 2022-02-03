@extends('layout.app')

@section('title', 'ユーザーページ')

@section('main')
<div class="mypage-name">
    <div class="my-icon">
        @if(isset($user->image_path))
        <img src="{{ Storage::url($user->image_path) }}" alt="マイアイコン">
        @else
        <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
        @endif
    </div>
    <div class="my-name-box">
        <div class="my-name">
            <h1>{{ $user->nickname }}</h1>
            <p>{{ '@'.$user->name }}</p>
        </div>
        <div class="button-box">
            <a class="btn btn-outline-dark" href="#" role="button">フォローする</a>
        </div>
    </div>
</div>
<div class="count">
    <div class="count-box line">
        <p>投稿</p>
        <p class="lang-color">{{ $post_count }}</p>
        <p>件</p>
    </div>
    <div class="count-box line">
        <p>フォロワー</p>
        <p class="lang-color">70</p>
        <p>人</p>
    </div>
    <div class="count-box">
        <p>フォロー</p>
        <p class="lang-color">85</p>
        <p>人</p>
    </div>
</div>
<div class="mypage-icon">
    <div class="mypage-icon-box">
        <a href="/mypage/post"><img src="{{ asset('/img/list.png') }}" alt="リストアイコン"></a>
    </div>
</div>
<div class="mypage-posts">
    @if($posts->isEmpty())
        <p class="p-3">投稿がありません。</p>
    @else
    @foreach($posts as $post)
        <div class="post-box">
            <div class="photo-box">
                @if(file_exists(public_path().'/storage/post_img/'. $post->id .'.jpg'))
                    <img src="/storage/post_img/{{ $post->id }}.jpg">
                @elseif(file_exists(public_path().'/storage/post_img/'. $post->id .'.jpeg'))
                    <img src="/storage/post_img/{{ $post->id }}.jpeg">
                @elseif(file_exists(public_path().'/storage/post_img/'. $post->id .'.png'))
                    <img src="/storage/post_img/{{ $post->id }}.png">
                @elseif(file_exists(public_path().'/storage/post_img/'. $post->id .'.gif'))
                    <img src="/storage/post_img/{{ $post->id }}.gif">
                @elseif(file_exists(public_path().'/storage/post_img/'. $post->id .'.mp4'))
                    <video src="/storage/post_img/{{ $post->id }}.mp4" autoplay loop playsinline></video>
                @elseif(file_exists(public_path().'/storage/post_img/'. $post->id .'.mov'))
                    <video src="/storage/post_img/{{ $post->id }}.mov" autoplay loop playsinline></video>
                @elseif(file_exists(public_path().'/storage/post_img/'. $post->id .'.wmv'))
                    <video src="/storage/post_img/{{ $post->id }}.wmv" autoplay loop playsinline></video>
                @endif
            </div>
        </div>
    @endforeach
    @endif
</div>
@endsection