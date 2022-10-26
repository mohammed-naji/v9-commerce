@extends('admin.master')

@section('title', 'Customers Page | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Customers Page</h1>

<table class="table table-hover table-bcustomered table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Orders</th>
        <th>Created At</th>
        <th>Updated At</th>
        {{-- <th>Actions</th> --}}
    </tr>

    @forelse ($customers as $customer)
    <tr>
        <td>{{ $customer->id }}</td>
        <td>{{ $customer->name }}</td>
        <td>{{ $customer->email }}</td>
        <td>
            <ul>
                @foreach ($customer->orders as $order)
                <li><a href="{{ route('admin.orders_details', $order->id) }}">Order #{{ $order->id }} - {{ $order->total }}$</a></li>
                @endforeach
            </ul>
        </td>
        {{-- <td>{{ $customer->created_at->format('d-m-Y') }}</td>
        <td>{{ $customer->updated_at->diffForHumans() }}</td> --}}
        {{-- <td class="text-center">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.categories.edit', $customer->id) }}"><i class="fas fa-eye"></i></a>
        </td> --}}
    </tr>
    @empty
    <tr>
        <td colspan="6">No Data found</td>
    </tr>
    @endforelse

</table>

{{ $customers->links() }}

@stop
