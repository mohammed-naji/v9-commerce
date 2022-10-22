@extends('admin.master')

@section('title', 'Create New Category | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Category</h1>

@include('admin.errors')

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
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
        <div class="col-md-12">
            <div class="mb-3">
                <label>Parent Category</label>
                <select name="parent_id" class="form-control" >
                    <option value="">--Select--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name_en }}</option>
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
