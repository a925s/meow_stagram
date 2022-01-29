@extends('layout.app')

@section('title', 'ホーム')

@section('main')
<div class="posts-box">
    @foreach($posts as $post)
    <div class="post-box">
        <div class="name">
            <div class="post-my-icon">
                <a href="#"><img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン"></a>
            </div>
            <div class="post-my-name">
                <a href="#">
                    <span class="nickname">{{ $post->user->nickname }}</span>
                    <span class="user-name">{{ '@'.$post->user->name }}</span>
                </a>
            </div>
        </div>
        <div class="photo">
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
            <p>{{ $post->body }}</p>
            <p class="post-date">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection