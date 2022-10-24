@extends('admin.master')

@section('title', 'Edit Category | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

@include('admin.errors')

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row">

        <div class="col-md-6">
            <div class="mb-3">
                <label>English Name</label>
                <input type="text" name="name_en" placeholder="English Name" class="form-control" value="{{ old('name_en', $category->name_en) }}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label>Arabic Name</label>
                <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control" value="{{ old('name_ar', $category->name_ar) }}" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label>Image</label>
                <input type="file" id="imginput" name="image" class="form-control" />
                @if ($category->image != 'no-image.png')
                    <img width="100" id="showimage" src="{{ asset('uploads/categories/'.$category->image) }}" alt="">
                @endif
                </td>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label>Parent Category</label>
                <select name="parent_id" class="form-control" >
                    <option value="">--Select--</option>
                    @foreach ($categories as $item)
                        <option {{ $category->parent_id == $item->id ? 'selected' : ''}}  value="{{ $item->id }}">{{ $item->name_en }}</option>
                    @endforeach
                </select>

            </div>
        </div>

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

@stop
