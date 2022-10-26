@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'All Products | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Products</h1>

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
        <th>Parent</th>
        <th>Price</th>
        <th>Quantity</th>
        {{-- <th>Children</th> --}}
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>

    @forelse ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->$name }}</td>
        <td>
            @php
                $src = asset('uploads/products/'.$product->image);
                if ($product->image == 'no-image.png') {
                    $src = asset('uploads/no-image.png');
                }
            @endphp
            <img width="100" src="{{ $src }}" alt=""></td>
        <td>{{ $product->category->$name ? $product->category->$name : "" }}</td>
        {{-- <td>
            <ul>
            @foreach ($product->children as $item)
                <li>{{ $item->$name }}</li>
            @endforeach
        </ul>
        </td> --}}
        <td>{{ $product->price }}</td>
        <td>{!! $product->quantity <= 20 ? '<span class="badge badge-danger text-white">'.$product->quantity.'</span>' : $product->quantity !!}</td>
        <td>{{ $product->created_at->format('d-m-Y') }}</td>
        <td>{{ $product->updated_at->diffForHumans() }}</td>
        <td>
            {{-- @if ($product->id != 1) --}}
            <a class="btn btn-primary btn-sm" href="{{ route('admin.products.edit', $product->id) }}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
            {{-- @endif --}}
        </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9">No Data found</td>
    </tr>
    @endforelse

</table>

{{ $products->links() }}

@stop

@section('scripts')
<script>

    setTimeout(() => {
        $('.alert').fadeOut()
    }, 3000);

</script>
@stop
