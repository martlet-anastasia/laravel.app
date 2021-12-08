<?php

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

    // Add 2 entries to Category DB

    // Using new object
    $category = new Category();
    $category->name = 'Laptops';
    $category->save();

    // Using create()
    $data = [
        'name' => 'Phones',
        'status' => 0,
    ];
    $category = Category::create($data);
    $category->save();

    // check that entries were added to DB
    // $show_category = Category::all();
    // dd($show_category);

    return view('main');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/store', function () {
    return view('store');
});


Route::get('hello', [SiteController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
