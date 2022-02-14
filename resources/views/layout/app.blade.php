<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ホームページ">
    <link rel="shortcut icon" href="{{ asset('/img/cat_favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/cat.css') }}">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" defer></script>
    <script src="{{ mix('js/like.js') }}" defer></script>
    <script src="{{ mix('js/bookmark.js') }}" defer></script>
    <script src="{{ mix('js/follow.js') }}" defer></script>
    <script src="{{ mix('js/cat.js') }}" defer></script>

    <title>@yield('title')</title>
</head>
<body>
    <div class="container">
        <div class="side">
            <div class="side-inner">
                <ul class="nav">
                    <li class="nav-item top-icon"><a href="/sns" class="nav-link top-icon"><img src="{{ asset('/img/cat.jpg') }}" class="top-icon" alt="猫アイコン"></a></li>
                    <li class="nav-item"><a href="/sns" class="nav-link"><img src="{{ asset('/img/home.png') }}" alt="ホームアイコン"><p>ホーム</p></a></li>
                    <li class="nav-item"><a href="/search" class="nav-link"><img src="{{ asset('/img/search.svg') }}" alt="検索アイコン"><p>検索</p></a></li>
                    <li class="nav-item"><a href="/notification" class="nav-link"><img src="{{ asset('/img/notification.png') }}" alt="通知アイコン"><p>通知</p></a></li>
                    <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#js-modal"><img src="{{ asset('/img/post.png') }}" alt="投稿アイコン"><p>投稿</p></a></li>
                    <li class="nav-item my-icon js-popover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-html="true" data-bs-content="<a href='/mypage/post'>プロフィール</a><br><a href='{{ route('logout') }}'>ログアウト</a>">
                        @if(isset(Auth::user()->image_path))
                        <img src="{{ Storage::url(Auth::user()->image_path) }}" class="my-icon" alt="マイアイコン">
                        @else
                        <img src="{{ asset('/img/cat.jpg') }}" class="my-icon" alt="マイアイコン">
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div class="modal fade" id="js-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h2 class="modal-title">新規投稿を作成</h2>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="file" class="form-control form-control-sm" name="post_img" required>
                            </div>
                            <input type="text" class="form-control mb-4" name="body" placeholder="ひとことメッセージ" maxlength="100" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" type="submit">投稿する</button>
                            <button class="btn btn-reverse" data-bs-dismiss="modal">キャンセル</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="main">
            <div class="ditch"></div>
            @yield('main')
        </div>
    </div>
    <script>
        'use strict'
        document.addEventListener('DOMContentLoaded', function() {
            $('.js-popover').popover();
        }, false);
    </script>
</body>
</html>
