@extends('layouts.default')

@section('title', 'メール認証')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/verify-email.css') }}">
@endsection

@section('content')
@include('components.header')
<div class="container">
    <p>登録していただいたメールアドレスに認証メールを送付しました。</p>
    <p>メール認証を完了してください。</p>
    <a class="link" href="">認証はこちらから</a>
    <form action="/email/verify" method="post">
        @csrf
        <p class="mail__link">認証メールを再送する</p>
    </form>
</div>
@endsection