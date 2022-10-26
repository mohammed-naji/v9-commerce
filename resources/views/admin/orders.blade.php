@extends('admin.master')

@section('title', 'Orders Page | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Orders Page</h1>

<table class="table table-hover table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Total</th>
        <th>User</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>

    @forelse ($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->total }}$</td>
        <td>{{ $order->user->name }}</td>
        <td>{{ $order->created_at->format('d-m-Y') }}</td>
        <td>{{ $order->updated_at->diffForHumans() }}</td>
        <td class="text-center">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.orders_details', $order->id) }}"><i class="fas fa-eye"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">No Data found</td>
    </tr>
    @endforelse

</table>

{{ $orders->links() }}

@stop
