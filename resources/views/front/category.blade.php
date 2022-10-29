@extends('front.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', $category->$name . ' | ' . env('APP_NAME'))

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">{{ $category->$name }}</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('site.home') }}">Home</a></li>
						<li class="active">{{ $category->$name }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="products section">
	<div class="container">
		<div class="row">

            @foreach ($category->products as $product)
            <div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
                        @if ($product->sale_price)
                        <span class="bage">Sale</span>
                        @endif

						<img class="img-responsive" src="{{ asset('uploads/products/'.$product->image) }}" alt="product-img">
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">{{ $product->$name }}</a></h4>
						<p class="price">{!! $product->sale_price ? '<del style="margin-right: 3px;font-size:12px">$'.$product->price.'</del> <sup>$</sup>' . $product->sale_price : '<sup>$</sup>' . $product->price !!}</p>
					</div>
				</div>
			</div>
            @endforeach


		</div>
	</div>
</section>

@stop
