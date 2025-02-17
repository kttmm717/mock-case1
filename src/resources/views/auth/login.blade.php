@extends('layouts.default')

@section('title', '新規登録')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth.css') }}">
@endsection

@section('content')
@include('components.header')
<form class="form" action="/login" method="post">
    @csrf
    <div class="container">
        <h2 class="form__title">ログイン</h2>
        <div class="groups">
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
        </div>
        <button class="btn">ログインする</button>
        <a class="link" href="/register">会員登録はこちら</a>
    </div>
</form>
@endsection