@extends('layouts.default')

@section('title', 'プロフィール設定')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('/css/profile.css') }}">
@endsection

@section('content')
@include('components.header')
<form class="form" action="/mypage/profile" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <h2 class="form__title">プロフィール設定</h2>
        <div class="user__img">
            @isset($user->profile->img_url)
                <img src="{{\Storage::url($user->profile->img_url)}}" alt="">
            @else
                <img id="myImage" src="{{asset('img/icon.png')}}" alt="">
            @endisset
            <label class="user__img--label">
                画像を選択する
                <input id="target" class="user__img--input" type="file" name="img_url" accept="image/png, image/jpeg">
            </label>
        </div>
        <div class="groups">
            <div class="group">
                <p class="item-name">ユーザー名</p>
                <input type="text" name="name" value="{{$user->name}}">
                @error('name')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="group">
                <p class="item-name">郵便番号</p>
                <input type="text" name="postcode" value="{{$profile ? $profile->postcode : ''}}" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');">
                @error('postcode')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="group">
                <p class="item-name">住所</p>
                <input type="text" name="address" value="{{$profile ? $profile->address : ''}}">
                @error('address')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="group">
                <p class="item-name">建物名</p>
                <input type="text" name="building" value="{{$profile ? $profile->building : ''}}">
            </div>            
        </div>
        <button class="btn">登録する</button>
    </div>
</form>
<script>
const target = document.getElementById('target');
target.addEventListener('change', function (e) {
    const file = e.target.files[0]
    const reader = new FileReader();
    reader.onload = function (e) {
        const img = document.getElementById("myImage");
        console.log(img.src);
        img.src = e.target.result;
        console.log(img.src);
    }
    reader.readAsDataURL(file);
}, false);
</script>
@endsection