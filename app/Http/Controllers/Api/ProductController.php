<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Database\Seeders\ProductSeeder;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return response()->json(Product::all(), 200);
//        return ProductResource::collection(Product::paginate(10));
//        return new ProductCollection(Product::paginate());
//        \Artisan::call('command:test ololo', [
//            'name' => 'hghhg',
//            '--Q' => true
//        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return ProductResource
     */
    public function show($id, ProductService $productService)
    {
//        $product = Product::find($id);
//        if($product) {
//            return response()->json($product);
//        }
//        return response()->json([
//            'error' => 'Product not found'
//        ], 404);

//        return new ProductResource(Product::findOrFail($id));

        return new ProductResource($productService->getProductById());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
