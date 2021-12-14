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

    // check that entries were added to DB
    // $show_category = Category::all();
    // dd($show_category);

    return view('main');
});

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
