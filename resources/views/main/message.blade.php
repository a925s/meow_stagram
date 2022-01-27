@extends('layout.app')

@section('title', 'メッセージ')

@section('main')
<div class="messages">
    <a href="#">
        <div class="message-box">
            <div class="message-icon">
                <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
            </div>
            <div class="message-name">
                <h2>太郎さん</h2>
                <p>こんにちは！<span>4時間前</span></p>
            </div>
        </div>
    </a>
    <a href="#">
        <div class="message-box">
            <div class="message-icon">
                <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
            </div>
            <div class="message-name">
                <h2>次郎さん</h2>
                <p>ありがとうございます！<span>5日前</span></p>
            </div>
        </div>
    </a>
    <a href="#">
        <div class="message-box">
            <div class="message-icon">
                <img src="{{ asset('/img/cat.jpg') }}" alt="マイアイコン">
            </div>
            <div class="message-name">
                <h2>三郎さん</h2>
                <p>元気ですか？<span>1週間前</span></p>
            </div>
        </div>
    </a>
</div>
@endsection