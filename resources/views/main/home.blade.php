@extends('layout.app')

@section('title', 'ホーム')

@section('main')
<div class="posts-box">
    @if($posts->isEmpty())
        <p class="p-3">投稿がありません。</p>
    @else
        @foreach($posts as $post)
            <div class="post-box">
                <div class="name">
                    <div class="post-my-icon">
                        @if($user->id == $post->user_id)
                        <a href="/mypage/post">
                        @else
                        <a href="/user/{{ $post->user_id }}">
                        @endif
                            @if(isset($post->user->image_path))
                            <img src="{{ Storage::url($post->user->image_path) }}" alt="マイアイコン">
                            @else
                            <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                            @endif
                        </a>
                    </div>
                    <div class="post-my-name">
                        @if($user->id == $post->user_id)
                        <a href="/mypage/post">
                        @else
                        <a href="/user/{{ $post->user_id }}">
                        @endif
                            <span class="nickname">{{ $post->user->nickname }}</span>
                            <span class="user-name">{{ '@'.$post->user->name }}</span>
                        </a>
                    </div>
                    @if($user->id == $post->user_id)
                    <div class="menu-icon">
                        <img src="{{ asset('/img/menu.png') }}">
                    </div>
                    @endif
                </div>
                <div class="photo">
                    <div class="photo-box">
                        @if(pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'gif' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'jpg' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'png')
                            <img src="{{ Storage::url($post->image->image_path) }}">
                        @elseif(pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mp4' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mov' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'wmv')
                            <video src="{{ Storage::url($post->image->image_path) }}" autoplay loop playsinline></video>
                        @endif
                    </div>
                </div>
                <div class="photo-bottom-icon">
                    @if(is_null($post->post_like_id()))
                        <div class="photo-icon js-like" data-post-id="{{ $post->id }}" data-like-id="null">
                            <img src="{{ asset('/img/like.png') }}">
                        </div>
                    @else
                        <div class="photo-icon js-like" data-post-id="{{ $post->id }}" data-like-id="{{ $post->post_like_id() }}">
                            <img src="{{ asset('/img/like-red.png') }}">
                        </div>
                    @endif

                    @if(is_null($post->post_bookmark_id()))
                        <div class="photo-bookmark-icon js-bookmark" data-post-id="{{ $post->id }}" data-bookmark-id="null">
                            <img src="{{ asset('/img/bookmark.svg') }}">
                        </div>
                    @else
                        <div class="photo-bookmark-icon js-bookmark" data-post-id="{{ $post->id }}" data-bookmark-id="{{ $post->post_bookmark_id() }}">
                            <img src="{{ asset('/img/bookmark-black.svg') }}">
                        </div>
                    @endif
                </div>
                <div class="text-box">
                    <p class="like-count">いいね！<span class="js-like-count">{{ $post->like_count() }}</span>件</p>
                    <p>{{ $post->body }}</p>
                    <p class="post-date">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection