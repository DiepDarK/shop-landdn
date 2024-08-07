<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart()
    {
        // dd(session()->all());
        // session()->put('cart', []);
        $cart = session()->get('cart', []);

        $total = 0;
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = 30000;
        $total = $subtotal + $shipping;

        return view('clients.cart', compact('cart', 'total','subtotal','shipping'));
    }
    public function addCart(Request  $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // dd($request->all());
        $product = Product::query()->findOrFail($productId);
        
        // Khởi tạo 1 mảng chứa thông tin giỏ hàng trên session
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            // Sản phẩm đã tồn tại trong giỏ hàng
            $cart[$productId]['quantity'] += $quantity;

        } else {
            // Sản phẩm chưa tồn tại trong giỏ hàng
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => isset($product->sale_price) ? $product->sale_price : $product->price,
                'image' => $product->image,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back();

    }
    public function updateCart(Request  $request)
    {
        $cartNew = $request->input('cart', []);
        session()->put('cart', $cartNew);
        return redirect()->back();
    }
}
