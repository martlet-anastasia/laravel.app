<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index(Request $request) {
        $cart = Session::get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        // session()->flash('message', '111');
        // dump(Session::all());
        // session()->put('count', 1);
//        session()->increment('count');
//        session()->forget('arr');

//        $request->session()->push('test', 'rrrrrr');
        // return dump($request->session()->pull('ters', '1'));
    }

    public function addToCart(Request $request) {
        $productID = $request->get('product_id');
        $cart = \session('cart', []);

        if(isset($cart[$productID])) {
            $cart[$productID] += 1;
        } else {
            $cart[$productID] = 1;
        }

        session([
            'cart' => $cart
        ]);

        // return redirect()->to(route('cart'));
        return back();
    }

}
