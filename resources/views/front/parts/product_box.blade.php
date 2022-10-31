<div class="product-item">
    <div class="product-thumb">
        @if ($product->sale_price)
        <span class="bage">Sale</span>
        @endif

        <img class="img-responsive" src="{{ asset('uploads/products/'.$product->image) }}" alt="product-img">
    </div>
    <div class="product-content">
        <h4><a href="{{ route('site.product', $product->id) }}">{{ $product->$name }}</a></h4>
        <p class="price">{!! $product->sale_price ? '<del style="margin-right: 3px;font-size:12px">$'.$product->price.'</del> <sup>$</sup>' . $product->sale_price : '<sup>$</sup>' . $product->price !!}</p>
    </div>
</div>
