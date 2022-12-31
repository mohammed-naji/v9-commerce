<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
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

    public function cart()
    {
        return view('front.cart');
    }

    public function update_cart(Request $request)
    {
        $qyt = $request->input('product-quantity');
        foreach($qyt as $id => $newqyt) {
            Cart::find($id)->update(['quantity' => $newqyt]);
        }

        return redirect()->route('site.cart');
    }

    public function remove_cart($id)
    {
        Cart::destroy($id);

        return redirect()->back();
    }

    public function checkout()
    {
        // $user = User::find(Auth::id());
        $total = Auth::user()->carts()->sum(DB::raw('price * quantity'));
        // dd($total);

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=$total" .
                    "&currency=USD" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode($responseData, true);
        $id = $responseData['id'];

        return view('front.checkout', compact('id'));
    }

    public function result(Request $request)
    {
        // dd($request->all());

        $resourcePath = $request->resourcePath;

        $url = "https://eu-test.oppwa.com$resourcePath";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseData = json_decode( $responseData, true );

        // dd($responseData);

        $total = $responseData['amount'];
        $transaction_id = $responseData['id'];
        $code = $responseData['result']['code'];

        if($code == '000.100.110') {

            // Create New Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total
            ]);

            foreach(Auth::user()->carts as $cart) {
                OrderItem::create([
                    'user_id' => $cart->user_id,
                    'product_id' => $cart->product_id,
                    'order_id' => $order->id,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                ]);

                $cart->product->update(['quantity' => $cart->product->quantity - $cart->quantity]);

                $cart->delete();
            }

            Payment::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'total' => $total,
                'transaction_id' => $transaction_id
            ]);

            return 'Done';
        }else {
            return 'Error';
        }
    }
}
