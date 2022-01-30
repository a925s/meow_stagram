@extends('layout.app')

@section('title', '検索')

@section('main')
<div class="search-box">
    <div class="search">
        <form action="#" method="get">
            <input type="text" name="search" placeholder="   検索">
        </form>
    </div>
</div>
<div class="order-box">
    <a href="/search/rank">
        <div class="order">
            <p class="rank-main">人気</p>
        </div>
    </a>
    <a href="/search/new">
        <div class="order">
            <p>最新</p>
        </div>
    </a>
    <a href="/search/video">
        <div class="order">
            <p>動画</p>
        </div>
    </a>
</div>
<div class="search-posts">
    @foreach($posts as $post)
    <div class="post-box">
        <a href="">
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
        </a>
    </div>
    @endforeach
</div>
@endsection