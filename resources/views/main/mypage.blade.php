@extends('layout.app')

@section('title', 'マイページ')

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
        <div class="button-box">
            <a class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#profile-modal" role="button">プロフィールを編集</a>
        </div>
    </div>
    <div class="modal fade" id="profile-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mypage">
                <form action="/update" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">プロフィールを編集</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="user">
                            @if(isset($user->image_path))
                            <img src="{{ Storage::url($user->image_path) }}" alt="マイアイコン">
                            @else
                            <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="image" class="mb-1">プロフィール写真</label>
                            <input type="file" class="form-control form-control-sm" name="image" id="image">
                        </div>

                        <input type="text" class="form-control mb-4" name="nickname" value="{{ $user->nickname }}" placeholder="ニックネーム" maxlength="50" required>
                        <input type="text" class="form-control mb-4" name="name" value="{{ $user->name }}" placeholder="ユーザー名" maxlength="50" required>
                        <input type="email" class="form-control mb-4" name="email" value="{{ $user->email }}" placeholder="メールアドレス" maxlength="254" required>
                        <input type="password" class="form-control mb-4" name="password" value="" placeholder="パスワードを変更する場合ご入力ください" minlength="4" maxlength="128">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-reverse" data-bs-dismiss="modal">キャンセル</button>
                        <button class="btn" type="submit">保存する</button>
                    </div>

                </form>
            </div>
        </div>
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
        <p class="lang-color">{{ $followed_count }}</p>
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
    <div class="mypage-icon-box">
        <a href="/mypage/bookmark"><img src="{{ asset('/img/bookmark.svg') }}" alt="ブックマークアイコン"></a>
    </div>
</div>
@if($type == 'post')
    <div class="mypage-posts">
        @if($posts->isEmpty())
            <p class="p-3">投稿がありません。</p>
        @else
        @foreach($posts as $post)
            <div class="post-box" data-bs-toggle="modal" data-bs-target="#post-modal-{{ $post->id }}">
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
@elseif($type == 'bookmark')
    <div class="mypage-posts">
        @if($bookmarks->isEmpty())
            <p class="p-3">ブックマークがありません。</p>
        @else
        @foreach($bookmarks as $bookmark)
            <div class="post-box" data-bs-toggle="modal" data-bs-target="#post-modal-{{ $bookmark->post_id }}">
                <div class="photo-box">
                    @if(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.jpg'))
                        <img src="/storage/post_img/{{ $bookmark->post_id }}.jpg">
                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.jpeg'))
                        <img src="/storage/post_img/{{ $bookmark->post_id }}.jpeg">
                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.png'))
                        <img src="/storage/post_img/{{ $bookmark->post_id }}.png">
                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.gif'))
                        <img src="/storage/post_img/{{ $bookmark->post_id }}.gif">
                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.mp4'))
                        <video src="/storage/post_img/{{ $bookmark->post_id }}.mp4" autoplay loop playsinline></video>
                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.mov'))
                        <video src="/storage/post_img/{{ $bookmark->post_id }}.mov" autoplay loop playsinline></video>
                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.wmv'))
                        <video src="/storage/post_img/{{ $bookmark->post_id }}.wmv" autoplay loop playsinline></video>
                    @endif
                </div>
            </div>
            <div class="modal fade" id="post-modal-{{ $bookmark->post_id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="top-name">
                                <div class="post-my-icon">
                                    @if(isset($bookmark->post->user->image_path))
                                    <img src="{{ Storage::url($bookmark->post->user->image_path) }}" alt="マイアイコン">
                                    @else
                                    <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                                    @endif
                                </div>
                                <div class="post-my-name">
                                    <span class="nickname">{{ $bookmark->post->user->nickname }}</span>
                                    <span class="user-name">{{ '@'.$bookmark->post->user->name }}</span>
                                </div>
                            </div>
                            <div class="photo"> 
                                <div class="photo-box">
                                    @if(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.jpg'))
                                        <img src="/storage/post_img/{{ $bookmark->post_id }}.jpg">
                                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.jpeg'))
                                        <img src="/storage/post_img/{{ $bookmark->post_id }}.jpeg">
                                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.png'))
                                        <img src="/storage/post_img/{{ $bookmark->post_id }}.png">
                                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.gif'))
                                        <img src="/storage/post_img/{{ $bookmark->post_id }}.gif">
                                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.mp4'))
                                        <video src="/storage/post_img/{{ $bookmark->post_id }}.mp4" autoplay loop playsinline></video>
                                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.mov'))
                                        <video src="/storage/post_img/{{ $bookmark->post_id }}.mov" autoplay loop playsinline></video>
                                    @elseif(file_exists(public_path().'/storage/post_img/'. $bookmark->post_id .'.wmv'))
                                        <video src="/storage/post_img/{{ $bookmark->post_id }}.wmv" autoplay loop playsinline></video>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-text-box">
                                <div class="name">
                                    <div class="post-my-icon">
                                        @if(isset($bookmark->post->user->image_path))
                                        <img src="{{ Storage::url($bookmark->post->user->image_path) }}" alt="マイアイコン">
                                        @else
                                        <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                                        @endif
                                    </div>
                                    <div class="post-my-name">
                                        <span class="nickname">{{ $bookmark->post->user->nickname }}</span>
                                        <span class="user-name">{{ '@'.$bookmark->post->user->name }}</span>
                                    </div>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="top-text-box">
                                    <p>{{ $bookmark->post->body }}</p>
                                    <p class="post-date">{{ $bookmark->post->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="photo-bottom-icon">
                                    @if(is_null($bookmark->post->post_like_id()))
                                        <div class="photo-icon js-like" data-post-id="{{ $bookmark->post_id }}" data-like-id="null">
                                            <img src="{{ asset('/img/like.png') }}">
                                        </div>
                                    @else
                                        <div class="photo-icon js-like" data-post-id="{{ $bookmark->post_id }}" data-like-id="{{ $bookmark->post->post_like_id() }}">
                                            <img src="{{ asset('/img/like-red.png') }}">
                                        </div>
                                    @endif

                                    @if(is_null($bookmark->post->post_bookmark_id()))
                                        <div class="photo-bookmark-icon js-bookmark" data-post-id="{{ $bookmark->post_id }}" data-bookmark-id="null">
                                            <img src="{{ asset('/img/bookmark.svg') }}">
                                        </div>
                                    @else
                                        <div class="photo-bookmark-icon js-bookmark" data-post-id="{{ $bookmark->post_id }}" data-bookmark-id="{{ $bookmark->post->post_bookmark_id() }}">
                                            <img src="{{ asset('/img/bookmark-black.svg') }}">
                                        </div>
                                    @endif
                                </div>
                                <div class="bottom-text-box">
                                    <p class="like-count">いいね！<span class="js-like-count">{{ $bookmark->post->like_count() }}</span>件</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
@endif
@endsection