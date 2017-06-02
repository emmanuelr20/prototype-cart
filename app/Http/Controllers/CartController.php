<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
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
        $cart_amount = \Session::get('cart_amount');
        $cart_amount += $product->price;
        
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
        \Session::put('cart_amount', $cart_amount);
        \Session::put('cart_count', $cart_count);
        return back();
    }

    public function clear()
    {
        \Session::forget('cart');
        \Session::forget('cart_count');
        \Session::forget('cart_amount');
        return back();
    }
    public function viewCart()
    {
        return view('cart/cart');
    }
    public function removeFromCart($item){
        $product = 'cart.' . $item;
        if(\Session::has($product)){
            $cart = \Session::get('cart');
            $cart_count = \Session::get('cart_count'); 
            $cart_amount = \Session::get('cart_amount'); 
            $cart_count -= (int)$cart[$item]['qty'];
            $cart_amount -= (int)$cart[$item]['qty'] * (float)$cart[$item]['price'];
            unset($cart[$item]);
            \Session::put('cart', $cart);
            \Session::put('cart_count', $cart_count);
            \Session::put('cart_amount', $cart_amount);
        }
        return back();
    }
    public function updateCart($item, Request $request){
        $this->validate($request, [
            'qty', 'numeric'
        ]);
        if($request->qty >= 0){
             $cart = \Session::get('cart');
            $cart_count = \Session::get('cart_count'); 
            $cart_amount = \Session::get('cart_amount'); 
            $cart_count -= $cart[$item]['qty'];
            $cart_amount -= $cart[$item]['qty'] * $cart[$item]['price'];
            $cart_amount += (int)$request->qty * (int)$cart[$item]['price'];
            $cart[$item]['qty'] = (int)$request->qty;
            $cart_count += (int)$request->qty;
            \Session::put('cart', $cart);
            \Session::put('cart_count', $cart_count);
            \Session::put('cart_amount', $cart_amount);
        }else{
            \Session::flash('message', 'Invalid quantity entered!');
        }
       
        return back();
    }
}
