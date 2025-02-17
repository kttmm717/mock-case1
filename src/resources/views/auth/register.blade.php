@extends('layouts.default')

@section('title', '新規登録')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth.css') }}">
@endsection

@section('content')
@include('components.header')
<form class="form" action="/register" method="post">
    @csrf
    <div class="container">
        <h2 class="form__title">会員登録</h2>
        <div class="groups">
            <div class="group">
                <p class="item-name">ユーザー名</p>
                <input type="text" name="name" value="{{old('name')}}">
                @error('name')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="group">
                <p class="item-name">メールアドレス</p>
                <input type="text" name="email" value="{{old('email')}}">
                @error('email')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="group">
                <p class="item-name">パスワード</p>
                <input type="password" name="password">
                @error('password')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="group">
                <p class="item-name">確認用パスワード</p>
                <input type="password" name="password_confirmation">
            </div>
        </div>
        <button class="btn">登録する</button>
        <a class="link" href="/login">ログインはこちら</a>
    </div>
</form>
@endsection