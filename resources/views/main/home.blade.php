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
                        @if($user_id == $post->user_id)
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
                        @if($user_id == $post->user_id)
                        <a href="/mypage/post">
                        @else
                        <a href="/user/{{ $post->user_id }}">
                        @endif
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
                    @if(is_null($post->post_like_id()))
                        <div class="photo-icon js-like" data-post-id="{{ $post->id }}" data-like-id="null">
                            <img src="{{ asset('/img/like.png') }}">
                        </div>
                    @else
                        <div class="photo-icon js-like" data-post-id="{{ $post->id }}" data-like-id="{{ $post->post_like_id() }}">
                            <img src="{{ asset('/img/like-red.png') }}">
                        </div>
                    @endif

                        <div class="photo-icon">
                            <img src="{{ asset('/img/send.png') }}" alt="メッセージアイコン">
                        </div>

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