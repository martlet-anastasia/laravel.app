<?php

    use App\Http\Controllers\FormController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\SiteController;
    use App\Models\Brand;
    use App\Models\Category;
    use App\Models\Product;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test-el', function () {
//    $brand = Brand::find(1);
//    dump($brand->products()->where('price', '>', 200)->get());

    $product = Product::find(2);
    \App\Models\Image::create([
         'url' => 'ololo',
        'imageable_id' => $product->id,
        'imageable_type' => Product::class
    ]);

});

Route::get('cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('add-to-cart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');


Route::get('/', function () {

//
//    // Using new object
//    $category = new Category();
//    $category->name = 'Laptops';
//    $category->save();
//
//    // Using create()
//    $data = [
//        'name' => 'Phones',
//        'status' => 0,
//    ];
//    $category = Category::create($data);
//
//    // check that entries were added to DB
//    // $show_category = Category::all();
//    // dd($show_category);    // Add 2 entries to Category DB


    return view('main');
});

Route::get('/ttt', function () {
    $products = Product::where('id', '<', 5)->with('brand')->get();
    foreach ($products as $pr) {
        dump($pr);
    }
});


Route::get('/admin', function () {
    return view('admin.index');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resources([
        'brand' => \App\Http\Controllers\Admin\BrandControllerr::class,
        'category' => \App\Http\Controllers\Admin\CategoryControllerr::class,
        'product' => \App\Http\Controllers\Admin\ProductControllerr::class,
    ]);

});

Route::get('test-file', function() {
    Storage::disk('public')->put('olol/3.txt', 'i am file number 3');
    $file = Storage::get('public/olol/2.txt');
    // dump($file);
    // Storage::delete('1.txt');
    // dump(Storage::path('olol/2.txt'));
    // dump(Storage::exists('olol/2.txt'));
    // dump(Storage::missing('olo6l/2.txt'));
    // return Storage::download('olol/2.txt', 'my_test_file.pdf');
    // $url = Storage::disk('public')->url('olol/3.txt');
    // $size = Storage::size('olol/2.txt';
    // dump($size);
    Storage::append('olol/2.txt', "\t Append new line goes here");
    Storage::prepend('olol/2.txt', "\t Prepend new line goes here");
    $file = Storage::get('olol/2.txt');
    echo $file;


});


//Route::middleware(['ololo', 'auth'])->prefix('admin')->name('admin.')->group(function() {
//    Route::get('/', function() {
//        echo 'test';
//    })->withoutMiddleware(['auth']);
//    Route::resources([
//        'brand' => \App\Http\Controllers\Admin\BrandControllerr::class,
//        'category' => \App\Http\Controllers\Admin\CategoryControllerr::class,
//        'product' => \App\Http\Controllers\Admin\ProductControllerr::class,
//    ]);
//
//});


Route::get('/show-form', [FormController::class, 'showForm'])
    ->name('nameShowForm');
Route::post('/show-form', [FormController::class, 'postForm'])
    ->name('namePostForm');

//Route::resource('brand', \App\Http\Controllers\Admin\BrandControllerr::class)
//    ->except(['destroy']);
//Route::resource('brand', \App\Http\Controllers\Admin\BrandControllerr::class)
//    ->only(['index', 'show']);
//Route::resource('category', \App\Http\Controllers\Admin\CategoryControllerr::class);
//Route::resource('product', \App\Http\Controllers\Admin\ProductControllerr::class);


Route::get('/product', function () {
    return view('product');
});

Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');


Route::get('/show-form', [FormController::class, 'showForm'])
    ->name('nameShowForm');
Route::post('/show-form', [FormController::class, 'postForm'])
    ->name('namePostForm');

Route::get('product/{id}', [ProductController::class, 'index'])->name('showProduct');

// Route::get('check/{id?}', [ProductController::class, 'index'])->name('showProduct');




Route::get('hello', [SiteController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
