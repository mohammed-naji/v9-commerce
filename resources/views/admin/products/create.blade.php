@extends('admin.master')

@section('title', 'Create New Product | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Product</h1>

@include('admin.errors')

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>English Name</label>
                <input type="text" name="name_en" placeholder="English Name" class="form-control" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label>Arabic Name</label>
                <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>English Description</label>
                <textarea rows="5" name="description_en" placeholder="English Description" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label>Arabic Description</label>
                <textarea rows="5" name="description_ar" placeholder="Arabic Description" class="form-control"></textarea>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" placeholder="Price" class="form-control" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label>Sale Price</label>
                <input type="number" name="sale_price" placeholder="Sale Price" class="form-control" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity" placeholder="Quantity" class="form-control" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control" >
                    <option value="">--Select--</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-success px-5"><i class="fas fa-plus"></i> Add</button>
        </div>

    </div>
</form>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'code'
    });
  </script>
@stop
