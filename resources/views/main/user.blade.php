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
        @if(is_null($user->follow_id()))
            <div class="button-box">
                <a class="btn btn-outline-dark js-follow" data-followed-user-id="{{ $user->id }}" data-follow-id="null" role="button">フォローする</a>
            </div>
        @else
            <div class="button-box">
                <a class="btn btn-outline-dark btn-reverse js-follow" data-followed-user-id="{{ $user->id }}" data-follow-id="{{ $user->follow_id() }}" role="button">フォローを外す</a>
            </div>
        @endif
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
        <p class="lang-color js-follow-count">{{ $followed_count }}</p>
        <p>人</p>
    </div>
    <div class="count-box">
        <p>フォロー</p>
        <p class="lang-color">{{ $follow_count }}</p>
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
        <div class="post-box" data-bs-toggle="modal" data-bs-target="#post-modal-{{ $post->id }}">
            <div class="photo-box">
                @if(pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'gif' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'jpg' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'png')
                    <img src="{{ Storage::url($post->image->image_path) }}">
                @elseif(pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mp4' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mov' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'wmv')
                    <video src="{{ Storage::url($post->image->image_path) }}" autoplay loop playsinline></video>
                @endif
            </div>
        </div>
        <div class="modal fade" id="post-modal-{{ $post->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="top-name">
                            <div class="post-my-icon">
                                @if(isset($post->user->image_path))
                                <img src="{{ Storage::url($post->user->image_path) }}" alt="マイアイコン">
                                @else
                                <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                                @endif
                            </div>
                            <div class="post-my-name">
                                <span class="nickname">{{ $post->user->nickname }}</span>
                                <span class="user-name">{{ '@'.$post->user->name }}</span>
                            </div>
                            <div class="menu-box">
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
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
                        <div class="modal-text-box">
                            <div class="name">
                                <div class="post-my-icon">
                                    @if(isset($post->user->image_path))
                                    <img src="{{ Storage::url($post->user->image_path) }}" alt="マイアイコン">
                                    @else
                                    <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                                    @endif
                                </div>
                                <div class="post-my-name">
                                    <span class="nickname">{{ $post->user->nickname }}</span>
                                    <span class="user-name">{{ '@'.$post->user->name }}</span>
                                </div>
                                <div class="menu-box">
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="top-text-box">
                                <p>{{ $post->body }}</p>
                                <p class="post-date">{{ $post->created_at->diffForHumans() }}</p>
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
                            <div class="bottom-text-box">
                                <p class="like-count">いいね！<span class="js-like-count">{{ $post->like_count() }}</span>件</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>
@endsection