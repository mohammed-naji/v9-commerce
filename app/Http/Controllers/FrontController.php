<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

}
