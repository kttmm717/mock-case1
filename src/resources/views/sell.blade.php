@extends('layouts.default')

@section('title', '出品ページ')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/sell.css') }}">
@endsection

@section('content')
@include('components.header')
<form class="form" action="/sell" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <h1 class="sell__title">商品の出品</h1>

        <h3 class="item__title">商品画像</h3>
        @error('img_url')
        <p class="error">{{$message}}</p>
        @enderror
        <div class="img__area"></div>
        <label class="img__label">
            画像を選択する
            <input class="img__input" type="file" name="img_url">
        </label>

        <h2 class="section__title">商品の詳細</h2>
        <h3 class="item__title">カテゴリー</h3>
        @error('categories')
        <p class="error">{{$message}}</p>
        @enderror
        <div class="categories">
            @foreach($categories as $category)
                <label class="category">
                    <input class="input__category" type="checkbox" name="categories[]" value="{{$category->id}}">
                    {{$category->category}}
                </label>
            @endforeach
        </div>
        <h3 class="item__title">商品の状態</h3>
        @error('condition_id')
        <p class="error">{{$message}}</p>
        @enderror
        <select class="select__condition" name="condition_id">
            <option value="null" hidden>選択してください</option>
            @foreach($conditions as $condition)
                <option value="{{$condition->id}}">{{$condition->condition}}</option>
            @endforeach
        </select>

        <h2 class="section__title">商品名と説明</h2>
        <h3 class="item__title">商品名</h3>
        @error('name')
        <p class="error">{{$message}}</p>
        @enderror
        <input class="input__name" type="text" name="name">
        <h3 class="item__title">商品の説明</h3>
        @error('description')
        <p class="error">{{$message}}</p>
        @enderror
        <textarea name="description"></textarea>
        <h3 class="item__title">販売価格</h3>
        @error('price')
        <p class="error">{{$message}}</p>
        @enderror
        <input class="input__price" type="text" name="price">

        <button class="btn">出品する</button>
    </div>
</form>
@endsection