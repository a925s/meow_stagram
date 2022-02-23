@extends('layout.app')

@section('title', '検索')

@section('main')
<div class="search-box">
    <div class="search">
        @if($type == 'rank')
        <form action="/search/rank" method="get">
        @elseif($type == 'new')
        <form action="/search/new" method="get">
        @elseif($type == 'video')
        <form action="/search/video" method="get">
        @else
        <form action="/search" method="get">
        @endif
            <div class="search-area">
                @if(isset($keyword))
                <input type="text" name="keyword" value="{{ $keyword }}">
                @else
                <input type="text" name="keyword" value="">
                @endif
                <button class="btn" type="submit">検索</button>
            </div>
        </form>
    </div>
</div>
<div class="order-box">
    <a href="/search/rank">
        <div class="order">
            @if($type == 'rank')
            <p class="rank-main">人気</p>
            @else
            <p>人気</p>
            @endif
        </div>
    </a>
    <a href="/search/new">
        <div class="order">
            @if($type == 'new')
            <p class="new">最新</p>
            @else
            <p>最新</p>
            @endif
        </div>
    </a>
    <a href="/search/video">
        <div class="order">
            @if($type == 'video')
            <p class="video">動画</p>
            @else
            <p>動画</p>
            @endif
        </div>
    </a>
</div>
<div class="mypage-posts">
    @if($posts->isEmpty())
        <p class="p-3">投稿がありません。</p>
    @else
        @foreach($posts as $post)
        @if($type == 'video')
            @if(pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mp4' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mov' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'wmv')
            <div class="post-box" data-bs-toggle="modal" data-bs-target="#post-modal-{{ $post->id }}" data-hover-id="{{ $post->id }}">
                <div class="photo-box">
                    <video src="{{ Storage::url($post->image->image_path) }}" autoplay loop playsinline></video>
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
                                <div class="menu-box">
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    @if($user_id == $post->user_id)
                                    <div class="menu-icon">
                                        <img src="{{ asset('/img/menu.png') }}">
                                    </div>
                                    @endif
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
                                    <div class="post-my-icon modal-name" data-user-id="{{ $user_id }}" data-post-user-id="{{ $post->user->id }}">
                                        @if(isset($post->user->image_path))
                                        <img src="{{ Storage::url($post->user->image_path) }}" alt="マイアイコン">
                                        @else
                                        <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                                        @endif
                                    </div>
                                    <div class="post-my-name modal-name" data-user-id="{{ $user_id }}" data-post-user-id="{{ $post->user->id }}">
                                        <span class="nickname">{{ $post->user->nickname }}</span>
                                        <span class="user-name">{{ '@'.$post->user->name }}</span>
                                    </div>
                                    <div class="menu-box">
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        @if($user_id == $post->user_id)
                                        <div class="menu-icon">
                                            <img src="{{ asset('/img/menu.png') }}">
                                        </div>
                                        @endif
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
            <div class="modal fade" id="delete-modal-{{ $post->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content delete-modal">
                        <div class="modal-body">
                            <p class="text-center">投稿を削除しますか？</p>
                        </div>
                        <div class="modal-footer">
                            <form action="/delete" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $post->id }}">
                                <button class="btn btn-reverse" data-bs-dismiss="modal">キャンセル</button>
                                <button class="btn" type="submit">削除する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @else
        <div class="post-box" data-bs-toggle="modal" data-bs-target="#post-modal-{{ $post->id }}" data-hover-id="{{ $post->id }}">
            <div class="photo-box">
                @if(pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'gif' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'jpg' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'png')
                    <img src="{{ Storage::url($post->image->image_path) }}">
                @elseif(pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mp4' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'mov' || pathinfo($post->image->image_path, PATHINFO_EXTENSION) == 'wmv')
                    <video src="{{ Storage::url($post->image->image_path) }}" autoplay loop playsinline></video>
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
                            <div class="menu-box">
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                @if($user_id == $post->user_id)
                                <div class="menu-icon" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $post->id }}">
                                    <img src="{{ asset('/img/menu.png') }}">
                                </div>
                                @endif
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
                                <div class="post-my-icon modal-name" data-user-id="{{ $user_id }}" data-post-user-id="{{ $post->user->id }}">
                                    @if(isset($post->user->image_path))
                                    <img src="{{ Storage::url($post->user->image_path) }}" alt="マイアイコン">
                                    @else
                                    <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                                    @endif
                                </div>
                                <div class="post-my-name modal-name" data-user-id="{{ $user_id }}" data-post-user-id="{{ $post->user->id }}">
                                    <span class="nickname">{{ $post->user->nickname }}</span>
                                    <span class="user-name">{{ '@'.$post->user->name }}</span>
                                </div>
                                <div class="menu-box">
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    @if($user_id == $post->user_id)
                                    <div class="menu-icon" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $post->id }}">
                                        <img src="{{ asset('/img/menu.png') }}">
                                    </div>
                                    @endif
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
        <div class="modal fade" id="delete-modal-{{ $post->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content delete-modal">
                    <div class="modal-body">
                        <p class="text-center">投稿を削除しますか？</p>
                    </div>
                    <div class="modal-footer">
                        <form action="/delete" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <button class="btn btn-reverse" data-bs-dismiss="modal">キャンセル</button>
                            <button class="btn" type="submit">削除する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    @endif
</div>
@endsection