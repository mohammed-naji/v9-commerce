<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariate;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function about()
    {
        return view('front.about');
    }

    public function shop()
    {
        $products = Product::latest('id')->paginate(6);
        return view('front.shop', compact('products'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        return view('front.category', compact('category'));
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);


        $next = Product::where('id', '>', $id)->first();
        $prev = Product::where('id', '<', $id)->orderByDesc('id')->first();

        // dd($prev);

        $colors = ProductVariate::where('product_id', $id)->where('type', 'color')->get();
        $sizes = ProductVariate::where('product_id', $id)->where('type', 'size')->get();

        // dd($colors);


        $related = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $id)->get();
        // dd($related);


        return view('front.product', compact('product', 'next', 'prev', 'colors', 'sizes', 'related'));
    }

    public function product_rate(Request $request, $id)
    {
        $request->validate([
            'star' => 'required',
            'content' => 'required',
        ]);

        Review::create([
            'content' => $request->content,
            'star' => $request->star,
            'product_id' => $id,
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }

}
