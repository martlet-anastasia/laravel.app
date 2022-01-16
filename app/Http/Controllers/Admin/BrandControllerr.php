<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandControllerr extends Controller
{

//    public function __construct()
//    {
//        $this->middleware['auth'];
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(5);

        return view('admin.brand.index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('logo');
        $data = $request->all();
        $data['logo'] = $file->store('logo','public');
        $brand = Brand::create($data);
        return redirect(route('admin.brand.index'));

        //dump($file->storeAs('new_folder', 'ghghghgh.png', 'public'));

        //Storage::disk('public')->put('test_upload/123.png', $file->getContent());
        // Storage::putFileAs('test_upd', $file, 'ggg_disk.png');
        // dd($file->getContent());
        // dd($request->allFiles());
        // dd(Storage::allDirectories());
        // dd($request->allFiles('logo'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        // $brand = Brand::find($id);
        dd($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
//      $data = compact('brand', 'ololo'); принимает название переменных и создает ассоциативный массив
        $data = compact('brand');
        return view('admin.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Brand $brand, Request $request)
    {
        $brand->fill($request->all());
        $brand->save();

        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $brand->delete();
        // back();
        return redirect(route('admin.brand.index'));
    }
}
