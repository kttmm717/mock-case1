@extends('layouts.default')

@section('title', '商品購入ページ')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/purchase.css') }}">
@endsection

@section('content')
@include('components.header')
<form class="purchase" action="/purchase/{{$item->id}}" method="post">
    @csrf
    <div class="container">
        <div class="left">
            <div class="item__information">
                <img class="img" src="{{\Storage::url($item->img_url)}}">
                <div class="item">
                    <p class="item__name">{{$item->name}}</p>
                    <p class="item__price">￥{{number_format($item->price)}}</p>
                </div>
            </div>
            <div class="method__information">
                <p class="section__title">支払い方法</p>
                <select id="payment" class="method__select" name="payment_method">
                    <option value="null">選択してください</option>
                    <option value="konbini">コンビニ支払い</option>
                    <option value="card">カード支払い</option>
                </select>
            </div>
            <div class="send__information">
                <div class="section__title--area">
                    <p class="section__title">配送先</p>
                    <button type="button" class="send__btn" id="destination__update">変更する</button>
                </div>
                <div class="send__input--area">
                    <div class="postcode">
                        〒<input type="text" name="sending_postcode" class="input_destination" value="{{$user->profile->postcode}}">
                    </div>
                    <input type="text" name="sending_address" class="input_destination" value="{{$user->profile->address}}">
                    @isset($user->profile->building)
                    <input type="text" name="sending_building" class="input_destination" value="{{$user->profile->building}}">
                    @endisset
                    <button type="button" class="send__btn" id="destination__setting">変更完了</button>
                </div>
            </div>
        </div>
        <div class="right">
            <table>
                <tr>
                    <th>商品代金</th>
                    <td>￥{{number_format($item->price)}}</td>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    <td id="pay_confirm"></td>
                </tr>
            </table>
            @if($item->sold())
                <button class="disable" disable>売り切れました</button>
            @elseif($item->mine())
                <button class="disable" disable>購入できません</button>
            @else
                <button class="purchase__btn">購入する</button>
            @endif
        </div>
    </div>
</form>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection