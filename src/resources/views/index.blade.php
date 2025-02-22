@extends('layouts.default')

@section('title', 'トップページ')

@section('css')
<link rel="stylesheet" href="{{asset('/css/index.css')}}">
@endsection

@section('content')
@include('components.header')
<div class="container">
    <div class="border">
        <a class="best" href="{{route('items', ['page'=>'best', 'search'=>$search])}}">おすすめ</a>
        @if(auth()->check())
        <a class="mylist" href="{{route('items', ['page'=>'mylist', 'search'=>$search])}}">マイリスト</a>
        @endif
    </div>
    <div class="items">
        @foreach($items as $item)
        <div class="item">
            <a href="/item/{{$item->id}}">
                @if($item->sold())
                <div class="item__img sold">
                    <img src="{{ \Storage::url($item->img_url) }}" alt="商品画像">
                </div>
                @else
                <div class="item__img">
                    <img class="item__img" src="{{ \Storage::url($item->img_url) }}" alt="商品画像">
                </div>  
                @endif
            </a>
            <p>{{$item->name}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection