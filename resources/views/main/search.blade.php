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
    <div class="order">
        <p>ランキング</p>
    </div>
    <div class="order">
        <p>最新</p>
    </div>
    <div class="order">
        <p>動画</p>
    </div>
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
            <img src="{{ asset('/img/post2.jpg') }}" alt="投稿写真">
        </div>
    </div>
</div>
@endsection