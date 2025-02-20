@extends('layouts.default')

@section('title', 'マイページ')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
@endsection

@section('content')
@include('components.header')
<div class="container">
    <div class="user">
        <div class="user__img">
            @isset($user->profile->img_url)
                <img src="{{\Storage::url($user->profile->img_url)}}">
            @else
                <img src="{{asset('img/icon.png')}}">
            @endisset
        </div>
        <div><p class="user__name">{{$user->name}}</p></div>
        <div></div>
        <div><a href="/mypage/profile" class="profile__link">プロフィールを編集</a></div>
    </div>
    
    <div class="border">
        <a class="sell" href="/mypage?page=sell">出品した商品</a>
        <a class="buy" href="/mypage?page=buy">購入した商品</a>
    </div>
    <div class="items">
        @foreach($items as $item)
        <div class="item">
            <a href="/item/{{$item->id}}">
                <img class="item__img" src="{{ \Storage::url($item->img_url) }}" alt="商品画像">
                <p class="item__name">{{ $item->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection