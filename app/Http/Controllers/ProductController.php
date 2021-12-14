<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id) {

        $product = Product::findOrFail($id);
        $products = Product::all();
        return view('product.product', [
            'product' => $product,
            'products' => $products,
        ]);
    }

    public function catalog() {
//        $offset = 0;
//        $products = Product::limit(9)
//            ->offset($offset)
//            ->get();

        $products = Product::where('status', 1)
            ->paginate(9);

//        $products = Product::all();
        return view('product.catalog', [
            'products' => $products
        ]);
    }
}
