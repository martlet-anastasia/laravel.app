<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Http\Requests\CreateProductRequest;

class ProductControllerr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'brands' => Brand::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        if(!is_null($request->file('img'))) {
            $path = $request->file('img')->store('public/products/img');
            $path = str_replace('public/', '', $path);
        } else {
            $path = 'https://thumbs.dreamstime.com/b/not-found-icon-design-line-style-perfect-application-web-logo-presentation-template-not-found-icon-design-line-style-169941512.jpg';
        }
        $data['img'] = $path;
        Product::create($data);
        return redirect(route('admin.product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'product' => $product,
            'brands' => Brand::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductRequest $request, Product $product)
    {
        $data = $request->all();
        if(empty($data['status'])) {
            $data['status'] = 0;
        }
        if(!is_null($request->file('img'))) {
            $path = $request->file('img')->store('public/products/img');
            $path = str_replace('public/', '', $path);
            $data['img'] = $path;
        }
        $product->fill($data);
        $product->save();

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->forceDelete();
        return redirect(route('admin.product.index'));
    }
}
