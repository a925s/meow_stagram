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
            <a class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#profile-modal" href="#" role="button">プロフィールを編集</a>
        </div>
    </div>
    <div class="modal fade" id="profile-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">プロフィールを編集</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="user">
                            <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="mb-1">プロフィール写真</label>
                            <input type="file" class="form-control form-control-sm" name="image" id="image">
                        </div>

                        <input type="text" class="form-control mb-4" name="nickname" value="太郎" placeholder="ニックネーム" maxlength="50" required>
                        <input type="text" class="form-control mb-4" name="name" value="taro" placeholder="ユーザー名" maxlength="50" required>
                        <input type="email" class="form-control mb-4" name="email" value="taro@techis.jp" placeholder="メールアドレス" maxlength="254" required>
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
        <a href="/mypage/post"><img src="{{ asset('/img/list.png') }}" alt="リストアイコン"></a>
    </div>
    <div class="mypage-icon-box">
        <a href="/mypage/bookmark"><img src="{{ asset('/img/bookmark.svg') }}" alt="ブックマークアイコン"></a>
    </div>
</div>
<div class="mypage-posts">
    <div class="post-box">
        <div class="photo-box">
            <img src="{{ asset('/img/post1.jpg') }}" alt="投稿写真">
        </div>
    </div>
    <div class="post-box">
        <div class="photo-box">
            <img src="{{ asset('/img/post2.jpg') }}" alt="投稿写真">
        </div>
    </div>
    <div class="post-box">
        <div class="photo-box">
            <video src="{{ asset('/img/cat-video.mp4') }}" autoplay loop playsinline></video>
        </div>
    </div>
</div>
@endsection