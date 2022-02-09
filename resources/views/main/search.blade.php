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
            <p>人気</p>
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
<div class="mypage-posts">
    @if($posts->isEmpty())
        <p class="p-3">投稿がありません。</p>
    @else
        @foreach($posts as $post)
        <div class="post-box" data-bs-toggle="modal" data-bs-target="#post-modal-{{ $post->id }}" data-hover-id="{{ $post->id }}">
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
            <div class="hover-box hover-box-{{ $post->id }}">
                <div class="mypage-name">
                    <div class="my-icon">
                        @if(isset($post->user->image_path))
                        <img src="{{ Storage::url($post->user->image_path) }}" alt="マイアイコン">
                        @else
                        <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                        @endif
                    </div>
                    <div class="my-name-box">
                        <div class="my-name">
                            <h1>{{ $post->user->nickname }}</h1>
                            <p>{{ '@'.$post->user->name }}</p>
                        </div>
                        @if(!is_null($post->user->follow_id()))
                            <p class="follow-now">フォローしています</p>
                        @endif
                    </div>
                </div>
                <div class="count">
                    <div class="count-box line">
                        <p>投稿</p>
                        <p class="lang-color">{{ $post->post_count() }}</p>
                        <p>件</p>
                    </div>
                    <div class="count-box line">
                        <p>フォロワー</p>
                        <p class="lang-color js-follow-count">{{ $post->followed_count() }}</p>
                        <p>人</p>
                    </div>
                    <div class="count-box">
                        <p>フォロー</p>
                        <p class="lang-color">{{ $post->follow_count() }}</p>
                        <p>人</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="post-modal-{{ $post->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="top-name modal-name" data-user-id="{{ $user_id }}" data-post-user-id="{{ $post->user->id }}">
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
                        <div class="modal-text-box">
                            <div class="name modal-name" data-user-id="{{ $user_id }}" data-post-user-id="{{ $post->user->id }}">
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
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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