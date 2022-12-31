@extends('front.master')

@php
    $name = 'name_' . app()->currentLocale();
    $description = 'description_' . app()->currentLocale();
@endphp

@section('styles')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
#full-stars-example-two .rating-group {
  display: inline-flex;
  /* make hover effect work properly in IE */
}
#full-stars-example-two .rating__icon {
  pointer-events: none;
  /* hide radio inputs */
}
#full-stars-example-two .rating__input {
  position: absolute !important;
  left: -9999px !important;
  /* hide 'none' input from screenreaders */
}
#full-stars-example-two .rating__input--none {
  display: none;
  /* set icon padding and size */
}
#full-stars-example-two .rating__label {
  cursor: pointer;
  padding: 0 0.1em;
  font-size: 2rem;
  /* set default star color */
}
#full-stars-example-two .rating__icon--star {
  color: orange;
  /* if any input is checked, make its following siblings grey */
}
#full-stars-example-two .rating__input:checked ~ .rating__label .rating__icon--star {
  color: #ddd;
  /* make all stars orange on rating group hover */
}
#full-stars-example-two .rating-group:hover .rating__label .rating__icon--star {
  color: orange;
  /* make hovered input's following siblings grey on hover */
}
#full-stars-example-two .rating__input:hover ~ .rating__label .rating__icon--star {
  color: #ddd;
}

.d-inline {
    display: inline;
}

.d-none {
    display: none;
}
</style>
@stop

@section('title', $product->$name . ' | ' . env('APP_NAME'))

@section('content')

    <section class="single-product">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('site.home') }}">Home</a></li>
                        <li><a href="{{ route('site.shop') }}">Shop</a></li>
                        <li class="active">{{ $product->$name }}</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol class="product-pagination text-right">
                        @if ($next)
                            <li><a href="{{ route('site.product', $next->id) }}"><i class="tf-ion-ios-arrow-left"></i> Next
                                </a></li>
                        @endif

                        @if ($prev)
                            <li><a href="{{ route('site.product', $prev->id) }}">Preview <i
                                        class="tf-ion-ios-arrow-right"></i></a></li>
                        @endif

                    </ol>
                </div>
            </div>
            <div class="row mt-20">
                <div class="col-md-5">
                    <div class="single-product-slider">
                        <img class="img-responsive" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-details">

                        @if (session('msg'))
                            <div class="alert alert-success">{{ session('msg') }}</div>
                        @endif

                        <h2>{{ $product->$name }}</h2>

                        {{-- <i class="tf-ion-star"></i>  --}}
                        {{ round($product->reviews->avg('star'), 2) }}

                        @php $rating = $product->reviews->avg('star'); @endphp

                        @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>

                                @if($rating >0)
                                    @if($rating >0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                        @endforeach

                        <br>
                        <br>

                        <p class="product-price">${{ $product->sale_price ? $product->sale_price : $product->price }}</p>

                        <p class="product-description mt-20">
                            {!! Str::words($product->$description, 50, '...') !!}
                        </p>
                        {{-- <div class="color-swatches">
						<span>color:</span>
						<ul>
                            @foreach ($colors as $item)
                            <li>
								<a href="#!" style="background: {{ $item->value }}" ></a>
							</li>
                            @endforeach
						</ul>
					</div>
					<div class="product-size">
						<span>Size:</span>
						<select class="form-control">
                            @foreach ($sizes as $item)
                            <option>{{ $item->value }}</option>
                            @endforeach
						</select>
					</div> --}}

                        <div class="product-category">
                            <span>Categories:</span>
                            <ul>
                                <li><a
                                        href="{{ route('site.category', $product->category_id) }}">{{ $product->category->$name }}</a>
                                </li>
                            </ul>
                        </div>

                        <form action="{{ route('site.add_to_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            {{-- <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="price" value="{{ $product->price }}"> --}}
                            <div class="product-quantity">
                                <span>Quantity:</span>
                                <div class="product-quantity-slider">
                                    <input id="product-quantity" class="product_quantity" type="text" min="1"
                                        value="1" name="product-quantity">
                                </div>
                            </div>
                            <button class="btn btn-main mt-20">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="tabCommon mt-20">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
                            <li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews
                                    ({{ $product->reviews->count() }})</a></li>
                        </ul>
                        <div class="tab-content patternbg">
                            <div id="details" class="tab-pane fade active in">
                                <h4>Product Description</h4>

                                {{-- {!! $product->$description !!} --}}

                                @php
                                    $smallcontent = Str::substr($product->$description, 0, 300);
                                    $remain = Str::substr($product->$description, 300);
                                @endphp

                                {!! $smallcontent !!}
                                <div id="fulltext" class="d-none">{!! $remain !!}</div>
                                <a href="https://google.ps"  id="read_more">Read More...</a>

                            </div>
                            <div id="reviews" class="tab-pane fade">
                                <div class="post-comments">
                                    <ul class="media-list comments-list m-bot-50 clearlist">
                                        @foreach ($product->reviews as $item)
                                            <!-- Comment Item start-->
                                            <li class="media">

                                                <a class="pull-left" href="#!">
                                                    <img class="media-object comment-avatar"
                                                        src="https://ui-avatars.com/api/?name={{ $item->user->name }}&background=random"
                                                        alt="" width="50" height="50">
                                                </a>

                                                <div class="media-body">
                                                    <div class="comment-info">
                                                        <h4 class="comment-author">
                                                            <a href="#!">{{ $item->user->name }}</a>

                                                        </h4>
                                                        <time datetime="2013-04-06T13:53">
                                                            {{ $item->created_at->format('F d, Y') }} at
                                                            {{ $item->created_at->format('h:i') }}
                                                        </time>
                                                        <a class="comment-button" href="#!"><i class="tf-ion-star"></i>
                                                            {{ $item->star }}</a>
                                                    </div>

                                                    <p>
                                                        {{ $item->content }}
                                                    </p>
                                                </div>

                                            </li>
                                            <!-- End Comment Item -->
                                        @endforeach

                                    </ul>




                                    @auth
                                    <hr>
                                    <h3>Post New Review</h3>
                                    <form action="{{ route('site.product_rate', $product->id) }}" method="POST">
                                        @csrf
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="star" id="star-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="star-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="star" id="star-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="star-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="star" id="star-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="star-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="star" id="star-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="star-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="star" id="star-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="star-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="star" id="star-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <textarea placeholder="Review here.." class="form-control" rows="4" name="content"></textarea>
                                        <button class="btn btn-main mt-20">Post Review</button>
                                    </form>
                                    @endauth

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="products related-products section">
        <div class="container">
            <div class="row">
                <div class="title text-center">
                    <h2>Related Products</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($related as $product)
                    <div class="col-md-3">
                        @include('front.parts.product_box')
                    </div>
                @endforeach


            </div>
        </div>
    </section>

@stop


@section('scripts')
<script>
    $('#read_more').click( function(e) {
        e.preventDefault();
        $('#fulltext').toggleClass('d-none');


        if($('#read_more').text() == 'Read More...' ) {
            $('#read_more').text('Read Less...')
        }else {
            $('#read_more').text('Read More...')
        }

    } )
</script>
@stop
