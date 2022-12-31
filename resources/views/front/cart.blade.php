@extends('front.master')

@php
    $name = 'name_' . app()->currentLocale();
@endphp

@section('title', 'Shop | ' . env('APP_NAME'))

@section('styles')
<style>
    .product-quantity-slider {
        width:  120px;
    }
    .product-quantity-slider input {
        height: 34px !important;
    }
</style>
@stop

@section('content')

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">Cart</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('site.home') }}">Home</a></li>
                        <li class="active">cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-wrapper">
    <div class="cart shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="block">
                        <div class="product-list">
                            <form method="post" action="{{ route('site.update_cart') }}">
                                @csrf
                                @method('put')

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="">Name</th>
                                            <th class="">Price</th>
                                            <th class="">Quantity</th>
                                            <th class="">Total</th>
                                            <th class="">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Auth::user()->carts as $cart)
                                        <tr class="">
                                            <td class="">
                                                <div class="product-info">
                                                    <img width="80" src="{{ asset('uploads/products/'.$cart->product->image) }}"
                                                        alt="">
                                                    <a href="{{ route('site.product', $cart->product_id) }}">{{ $cart->product->$name }}</a>
                                                </div>
                                            </td>
                                            <td class="">${{ $cart->price }}</td>
                                            <td class="">
                                                <div class="product-quantity">
                                                    <div class="product-quantity-slider">
                                                        <input id="product-quantity" type="text" min="1" value="{{ $cart->quantity }}"
                                                        class="product_quantity"
                                                        name="product-quantity[{{ $cart->id }}]">
                                                    </div>
                                                </div>
                                                {{-- <input type="number" name="" value="{{ $cart->quantity }}"></td> --}}
                                            <td class="">${{ $cart->quantity * $cart->price }}</td>
                                            <td class="">
                                                <a class="product-remove" href="{{ route('site.remove_cart', $cart->id) }}">Remove</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-main pull-left">Update Cart</button>
                                <a href="checkout.html" class="btn btn-main pull-right">Checkout</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
