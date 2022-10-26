<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Product::orderByDesc('id')->whereNull('parent_id')->paginate(10);
        $products = Product::orderByDesc('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $product = new Product();
        return view('admin.products.create', compact('categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Data
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required'
        ]);

        // Store Files
        $img_name = rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/products'), $img_name);


        // Store In Database
        Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'image' => $img_name,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Validate Data
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required'
        ]);

        $img_name = $product->image;
        if($request->hasFile('image')) {
            // Store Files
            File::delete('uploads/products/'.$product->image);
            $img_name = rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $img_name);
        }



        // Store In Database
        $product->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'image' => $img_name,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product updated successfully')->with('type', 'warning');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        File::delete('uploads/products/'.$product->image);


        $product->delete();

        return redirect()->route('admin.products.index')->with('msg', 'Product deleted successfully')->with('type', 'danger');
    }
}
