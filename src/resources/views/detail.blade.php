@extends('layouts.default')

@section('title', '商品詳細ページ')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/detail.css') }}">
@endsection

@section('content')
@include('components.header')
<div class="container">

    <img class="item__img" src="{{ \Storage::url($item->img_url) }}" alt="">

    <div class="information">
        <h1 class="item__name">{{$item->name}}</h1>
        <p class="item__price">￥{{number_format($item->price)}}<span>(税込)</span></p>
        <div class="icons">
            <div class="icon">
                <form action="{{$item->liked() ? '/delete-like/'.$item->id : '/create-like/'.$item->id}}" method="post">
                    @csrf
                    <button>
                        @if($item->liked())
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    </button>
                </form>
                <p class="count">{{$item->likeCount()}}</p>
            </div>
            <div class="icon">
                <i class="far fa-comment"></i>
                <p class="count">{{$item->commentCount()}}</p>
            </div>
        </div>
        @if($item->mine())
            <a href="#" class="btn disable">購入できません</a>
        @elseif($item->sold())
            <a href="#" class="btn disable">売り切れました</a>
        @else
            <a href="/purchase/{{$item->id}}" class="btn">購入手続きへ</a>
        @endif
        <h2 class="section__title">商品説明</h2>
        <p class="item__description">{{$item->description}}</p>
        <h2 class="section__title">商品の情報</h2>
        <table class="table">
            <tr class="table__row">
                <th class="table__header">カテゴリー</th>
                @foreach($item->categories() as $category)
                <td class="table__data category">{{$category->category}}</td>
                @endforeach
            </tr>
            <tr class="table__row">
                <th class="table__header">商品の状態</th>
                <td class="table__data">{{$item->condition->condition}}</td>
            </tr>
        </table>
        <div class="comment">
            <h2 class="comment__title">コメント({{$item->commentCount()}})</h2>
            @foreach($item->getComments() as $comment)
                <div class="user">
                    @isset($comment->user->img_url)
                        <img class="user__img" src="{{\Storage::url($comment->user->img_url)}}" alt="">
                    @else
                        <img class="user__img" src="{{asset('/img/icon.png')}}" alt="">
                    @endisset
                    <p class="user__name">{{$comment->user->name}}</p>
                </div>
                <div class="comment__content">{{$comment->comment}}</div>
            @endforeach
            <p>商品へのコメント</p>
            @error('comment')
                <p class="error">{{$message}}</p>
            @enderror
            <form action="/comment/{{$item->id}}" method="post">
                @csrf
                <textarea name="comment"></textarea>                   
                <button class="btn">コメントを送信する</button>
            </form>
        </div>
    </div>

</div>
@endsection