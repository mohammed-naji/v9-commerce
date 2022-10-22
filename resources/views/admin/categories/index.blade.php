@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'All Categories | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Categories</h1>

@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">
        {{ session('msg') }}
    </div>
@endif

<table class="table table-hover table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        {{-- <th>Parent</th> --}}
        <th>Children</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>

    @forelse ($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->$name }}</td>
        <td>
            @php
                $src = asset('uploads/categories/'.$category->image);
                if ($category->image == 'no-image.png') {
                    $src = asset('uploads/no-image.png');
                }
            @endphp
            <img width="100" src="{{ $src }}" alt=""></td>
        {{-- <td>{{ $category->parent->$name ? $category->parent->$name : "Main Category" }}</td> --}}
        <td>
            <ul>
            @foreach ($category->children as $item)
                <li>{{ $item->$name }}</li>
            @endforeach
        </ul>
        </td>
        <td>{{ $category->created_at->format('d-m-Y') }}</td>
        <td>{{ $category->updated_at->diffForHumans() }}</td>
        <td>
            {{-- @if ($category->id != 1) --}}
            <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.edit', $category->id) }}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
            {{-- @endif --}}
        </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">No Data found</td>
    </tr>
    @endforelse

</table>

{{ $categories->links() }}

@stop

@section('scripts')
<script>

    setTimeout(() => {
        $('.alert').fadeOut()
    }, 3000);

</script>
@stop
