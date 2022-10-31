<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $product = Product::find($request->product_id);
        $price = $product->sale_price ? $product->sale_price : $product->price;



        // // dd($cart);
        $qyt = $request->input('product-quantity');


        // $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        // if($cart) {
        //     $cart->update(['quantity' => $cart->quantity + $qyt]);
        // }else {
        //     Cart::create([
        //         'user_id' => Auth::id(),
        //         'product_id' => $request->product_id,
        //         'price' => $price,
        //         'quantity' => $qyt
        //     ]);
        // }

        Cart::updateOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ], [
            'price' => $price,
            'quantity' => DB::raw('quantity + ' . $qyt)
        ]);



        return redirect()->back()->with('msg', 'Product added to cart');
    }
}
