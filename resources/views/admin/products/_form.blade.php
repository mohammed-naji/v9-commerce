<div class="col-md-6">
    <div class="mb-3">
        <label>English Name</label>
        <input type="text" name="name_en" placeholder="English Name" class="form-control" value="{{ old('name_en', $product->name_en) }}" />
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Arabic Name</label>
        <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control" value="{{ old('name_ar', $product->name_ar) }}" />
    </div>
</div>
<div class="col-md-12">
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control" />
        @if ($product->image)
        <img width="100" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
        @endif

    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>English Description</label>
        <textarea rows="5" name="description_en" placeholder="English Description" class="form-control">{{ old('description_en', $product->description_en) }}</textarea>
    </div>
</div>
<div class="col-md-6">
    <div class="mb-3">
        <label>Arabic Description</label>
        <textarea rows="5" name="description_ar" placeholder="Arabic Description" class="form-control">{{ old('description_ar', $product->description_ar) }}</textarea>
    </div>
</div>
<div class="col-md-3">
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" placeholder="Price" class="form-control" value="{{ old('price', $product->price) }}" />
    </div>
</div>
<div class="col-md-3">
    <div class="mb-3">
        <label>Sale Price</label>
        <input type="number" name="sale_price" placeholder="Sale Price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}" />
    </div>
</div>
<div class="col-md-3">
    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" placeholder="Quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" />
    </div>
</div>
<div class="col-md-3">
    <div class="mb-3">
        <label>Categories</label>
        <select name="category_id" class="form-control" >
            <option value="">--Select--</option>
            @foreach ($categories as $item)
                <option {{ $product->category_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name_en }}</option>
            @endforeach
        </select>
    </div>
</div>
