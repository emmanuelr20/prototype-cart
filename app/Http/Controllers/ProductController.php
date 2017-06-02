<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;

class ProductController extends Controller
{
    protected $products;

    public function __construct(Product $products){
        $this->middleware('auth:admin')->except('index');
        $this->products = $products;
    }
    public function index()
    {
        $products = $this->products->all();
        return view('product.index', compact('products'));
    } 
    public function adminView(Request $request)
    {
        $products = $this->products->all();
        return view('admin.products', compact('products'));
    } 
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'price' => 'required|numeric'
        ]);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            ]);
        $imageName = $product->id . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path() . '/public/images/', $imageName);
        $img = '/images/' . $imageName;
        $product->img = $img;
        $product->save();
        \Session::flash('message', 'Product Has been successfully Created!');
        return back();        
    } 
    public function delete(Product $product)
    {
        $product->delete();
        return back();        
    } 
    public function getEdit(Product $product)
    {
        return view('admin.edit-product', compact('product'));
    }
    public function postEdit(Product $product, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'price' => 'required|numeric'
        ]);
        if ($request->file('image')){
            $imageName = $product->id . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/images/', $imageName);
            $img = '/images/' . $imageName;
            $product->img = $img;
        }
        $product->name = $request->name; 
        $product->price = $request->price;
        $product->save();
        \Session::flash('message', 'Product Has been successfully updated!');
        return back();
    }
}