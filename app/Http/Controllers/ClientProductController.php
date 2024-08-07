<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function productDetail(string $id){
        $longString = 90;
        $product = Product::query()->findOrFail($id);
        $listProduct = Product::query()->get();
        return view('clients.product-detail', compact('product','listProduct','longString'));
    }
    public function indexProduct(){
        $longString = 90;
        $listProduct = Product::query()->get();
        return view('clients.index', compact('listProduct','longString'));
    }
    public function shopProduct(){
        $longString = 90;
        $listProduct = Product::query()->get();
        $listCategory = Category::query()->get();
        return view('clients.shop', compact('listProduct','longString','listCategory'));
    }
}
