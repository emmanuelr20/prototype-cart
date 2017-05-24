<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;

class ProductController extends Controller
{
    protected $products;

    public function __construct(Product $products){
        $this->products = $products;
    }
    public function index()
    {
        $products = $this->products->all();
        return view('cart.index', compact('products'));
    }  
    public function addToCart(Product $product, Request $request)
    {
        $itemToAdd = [
            'name' => $product->name, 
            'price' => $product->price, 
            'id' => $product->id,
            'qty' => 1
            ];
        $cart = \Session::get('cart');
        $cart_count = \Session::get('cart_count');
        
        if ($cart != null) {
            if(array_key_exists($product->name, $cart)){
                $cart[$product->name]['qty'] += 1;
                $cart_count += 1;
            } else{
                $cart[$product->name] = $itemToAdd;
                $cart_count += 1;
            }
        } else {
            $cart = [$product->name => $itemToAdd];
            $cart_count = 1;
        }
        \Session::put('cart', $cart);
        \Session::put('cart_count', $cart_count);
        return back();
    }

    public function clear()
    {
        \Session::forget('cart');
        \Session::forget('cart_count');
        return back();
    }
    public function viewCart()
    {
        return view('cart/cart', compact('cart'));
    }
    public function removeFromCart($item){
        $cart = \Session::get('cart');
        $cart_count = \Session::get('cart_count'); 
        $cart_count -= $cart[$item]['qty'];
        unset($cart[$item]);
        \Session::put('cart', $cart);
        \Session::put('cart_count', $cart_count);
        return back();
    }
    public function updateCart($item, Request $request){
        $cart = \Session::get('cart');
        $cart_count = \Session::get('cart_count'); 
        $cart_count -= $cart[$item]['qty'];
        $cart[$item]['qty'] = (int)$request->qty;
        $cart_count += (int)$request->qty;
        \Session::put('cart', $cart);
        \Session::put('cart_count', $cart_count);
        return back();
    }
}