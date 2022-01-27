@extends('layout.app')

@section('title', 'マイページ')

@section('main')
<div class="mypage-name">
    <div class="my-icon">
        <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
    </div>
    <div class="my-name-box">
        <div class="my-name">
            <h1>太郎</h1>
            <p>@taro</p>
        </div>
        <div class="button-box">
            <a class="btn btn-outline-dark" href="#" role="button">プロフィールを編集</a>
        </div>
    </div>
</div>
<div class="count">
    <div class="count-box line">
        <p>投稿</p>
        <p class="lang-color">8</p>
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
        <img src="{{ asset('/img/list.png') }}" alt="リストアイコン">
    </div>
    <div class="mypage-icon-box">
        <img src="{{ asset('/img/bookmark.svg') }}" alt="ブックマークアイコン">
    </div>
</div>
<div class="mypage-posts">
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