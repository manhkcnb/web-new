<?php

namespace App\Http\ShoppingCart;

use Illuminate\Support\Facades\Session;

use DB;
use App\Models\Product;
use App\Models\Order;

trait Cart {

    public static function cartAdd($id){
        $cart = Session::get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
            $product = Product::find($id);
            if($cart[$id]['quantity']>=$product->quantity){
                $cart[$id]['quantity']=$product->quantity;
            }
        } else {
            $product = Product::find($id);
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'photo' => $product->photo,
                'quantity' => 1,
                'price' => $product->price,
                'discount' => $product->discount
            ];
        }
        Session::put('cart', $cart);
    }

    public static function cartAddWithNumber($id, $quantity){
        $cart = Session::get('cart');
        $product = Product::find($id);
        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $quantity;
           
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'photo' => $product->photo,
                'quantity' => $quantity,
                'price' => $product->price,
                'discount' => $product->discount
            ];
        }
        if($cart[$id]['quantity']>=$product->quantity){
            $cart[$id]['quantity']=$product->quantity;
        }
        Session::put('cart', $cart);
    }

    public static function cartUpdate($id, $quantity){
        $cart = Session::get('cart');
        if($quantity == 0){
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $quantity;
        }
        $product = Product::find($id);
        if($cart[$id]['quantity']>=$product->quantity){
            $cart[$id]['quantity']=$product->quantity;
        }
        Session::put('cart', $cart);
    }

    public static function cartDelete($id){
        $cart = Session::get('cart');
        unset($cart[$id]);
        Session::put('cart', $cart);
    }

    public static function cartTotal(){
        $cart = Session::get('cart');
        $total = 0;
        if($cart != ""){
            foreach($cart as $product){
                $total += ($product['price']-$product['price']*$product['discount']/100) * $product['quantity'];
            }
        }
        return $total;
    }

    public static function cartNumber(){
        $cart = Session::get('cart');
        $number = 0;
        if(isset($cart)){
            foreach($cart as $product){
                $number += $product['quantity'];
            }
        }
        return $number;
    }

    public static function cartList(){
        $cart = Session::get('cart');
        return $cart;
    }

    public static function cartDestroy(){
        Session::forget('cart');
    }

    public static function cartOrder(){
        //$customer = Session::get('customer');
        $customer_id = Session::get('customer_id');
       
        //---
        $cart = Session::get('cart');

        // Insert record into orders table
        $orderId = Order::insertGetId([
            'customer_id' => $customer_id,
            'price' => \App\Http\ShoppingCart\Cart::cartTotal(),
            'status' => 1,
            'date' => now(),
        ]);

        // Insert record into order_details table
        foreach ($cart as $product) {
            //tính lại giá thành sản phẩm sau khi giảm giá
            $price = $product['price'] - ($product['price'] * $product['discount'])/100;
            DB::table('order_details')->insert([
                'order_id' => $orderId,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $price,
            ]);
        }

        // Clear cart
        Session::forget('cart');
    }
    public static function cartOrderVnPay(){
        //$customer = Session::get('customer');
        $customer_id = Session::get('customer_id');
       
        //---
        $cart = Session::get('cart');

        // Insert record into orders table
        $orderId = Order::insertGetId([
            'customer_id' => $customer_id,
            'price' => \App\Http\ShoppingCart\Cart::cartTotal(),
            'status' => 2,
            'date' => now(),
        ]);

        // Insert record into order_details table
        foreach ($cart as $product) {
            //tính lại giá thành sản phẩm sau khi giảm giá
            $price = $product['price'] - ($product['price'] * $product['discount'])/100;
            DB::table('order_details')->insert([
                'order_id' => $orderId,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $price,
            ]);
        }

        // Clear cart
        Session::forget('cart');
    }

}       
