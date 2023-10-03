<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.products.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //\
        $image = $request->file('product_image');
        $filename = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        'Image'::make($image)->resize(800,750)->save('upload/product/'.$filename);
        $save_url = 'upload/product/'.$filename;
        Product::create([
            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'product_name'=>$request->product_name,
            'selling_price'=>$request->selling_price,
            'product_image'=>$save_url,
            'status'=>1,
            'created_at'=>Carbon::now(),

        ]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show',[
            'product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.products.edit',['product'=>$product],compact('brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $oldImage = $product->product_image;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/product/', $filename);
            $save_url = 'upload/product/' . $filename;

            /*
             * if updated delete old image from upload/Product folder
             */
            // if (file_exists($oldImage)) {
            //     unlink($oldImage);
            // }
        } else {
            $save_url = $product->product_image;
        }

        $product->update([
            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'product_name'=>$request->product_name,
            'selling_price'=>$request->selling_price,
            'status'=>1,
            'product_image'=>$save_url,
        ]);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function ProductInactive($id){
        Product::findOrFail($id)->update(['status'=>0]);
        return redirect()->route('products.index');
    }

    public function ProductActive($id){
        Product::findOrFail($id)->update(['status'=>1]);
        return redirect()->route('products.index');
    }
}
