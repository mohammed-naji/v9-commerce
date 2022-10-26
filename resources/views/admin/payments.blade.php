@extends('admin.master')

@section('title', 'Orders Page | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Payments Page</h1>

<table class="table table-hover table-bpaymented table-striped">
    <tr>
        <th>ID</th>
        <th>Total</th>
        <th>Order</th>
        <th>User</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>

    @forelse ($payments as $payment)
    <tr>
        <td>{{ $payment->id }}</td>
        <td>{{ $payment->total }}$</td>
        <td><a href="{{ route('admin.orders_details', $payment->order_id) }}">Details</a></td>
        <td>{{ $payment->user->name }}</td>
        <td>{{ $payment->created_at->format('d-m-Y') }}</td>
        <td>{{ $payment->updated_at->diffForHumans() }}</td>
        <td class="text-center">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.categories.edit', $payment->id) }}"><i class="fas fa-eye"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">No Data found</td>
    </tr>
    @endforelse

</table>

{{ $payments->links() }}

@stop
