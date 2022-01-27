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

    <title>@yield('title')</title>
</head>
<body>
    <div class="container">
        <div class="side">
            <div class="side-inner">
                <ul class="nav flex-column">
                    <li class="nav-item top-icon"><a href="#" class="nav-link top-icon"><img src="{{ asset('/img/cat.jpg') }}" class="top-icon" alt="猫アイコン"></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><img src="{{ asset('/img/home.png') }}" alt="ホームアイコン"><p>ホーム</p></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><img src="{{ asset('/img/search.svg') }}" alt="検索アイコン"><p>検索</p></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><img src="{{ asset('/img/notification.png') }}" alt="通知アイコン"><p>通知</p></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><img src="{{ asset('/img/send.png') }}" alt="メッセージアイコン"><p>メッセージ</p></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><img src="{{ asset('/img/post.png') }}" alt="投稿アイコン"><p>投稿</p></a></li>
                    <li class="nav-item my-icon"><a href="#" class="nav-link my-icon"><img src="{{ asset('/img/cat_favicon.png') }}" class="my-icon" alt="マイアイコン"></a></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="ditch"></div>
            @yield('main')
        </div>
    </div>
</body>
</html>
