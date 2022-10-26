@extends('admin.master')

@section('title', 'Edit Product | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Product</h1>

@include('admin.errors')

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row">

        @include('admin.products._form')

        <div class="col-12">
            <button class="btn btn-success px-5"><i class="fas fa-save"></i> Update</button>
        </div>

    </div>
</form>
@stop


@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>
    $('#imginput').on('change', function(e) {

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showimage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);

    })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'code'
    });
  </script>

@stop

