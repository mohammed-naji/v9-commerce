<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function orders()
    {
        $orders = Order::latest('id')->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function orders_details($id)
    {
        $order = Order::find($id);

        dd($order);
    }

    public function payments()
    {
        $payments = Payment::latest('id')->paginate(10);
        return view('admin.payments', compact('payments'));
    }

    public function customers()
    {
        $customers = User::with('orders')->where('type', 'user')->latest('id')->paginate(10);
        // dd($customers);
        return view('admin.customers', compact('customers'));
    }


}
