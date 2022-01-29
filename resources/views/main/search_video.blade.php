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
            <p class="rank">ランキング</p>
        </div>
    </a>
    <a href="/search/new">
        <div class="order">
            <p>最新</p>
        </div>
    </a>
    <a href="/search/video">
        <div class="order">
            <p class="video">動画</p>
        </div>
    </a>
</div>
<div class="search-posts">
    <div class="post-box">
        <div class="post-square-box">
            <img src="{{ asset('/img/post1.jpg') }}" alt="投稿写真">
        </div>
    </div>
    <div class="post-box">
        <div class="post-square-box">
            <img src="{{ asset('/img/post2.jpg') }}" alt="投稿写真">
        </div>
    </div>
    <div class="post-box">
        <div class="post-square-box">
            <video src="{{ asset('/img/cat-video.mp4') }}" autoplay loop playsinline></video>
        </div>
    </div>
</div>
@endsection