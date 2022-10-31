<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariate;
use Illuminate\Http\Request;

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


        return view('front.product', compact('product', 'next', 'prev', 'colors', 'sizes'));
    }

}
