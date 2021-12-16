<?php

    use App\Http\Controllers\FormController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\SiteController;
    use App\Models\Category;
    use App\Models\Product;
    use Illuminate\Support\Facades\Route;

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


Route::get('/admin', function () {
    return view('admin.index');
});


Route::resources([
    'brand' => \App\Http\Controllers\Admin\BrandControllerr::class,
    'category' => \App\Http\Controllers\Admin\CategoryControllerr::class,
    'product' => \App\Http\Controllers\Admin\ProductControllerr::class,
]);

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
