@extends('admin.master')

@section('title', 'Create New Product | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Product</h1>

@include('admin.errors')

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        @include('admin.products._form')
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
