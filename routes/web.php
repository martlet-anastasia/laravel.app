<?php

    use App\Http\Controllers\FormController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\SiteController;
    use App\Models\Brand;
    use App\Models\Category;
    use App\Models\Product;
    use App\Models\User;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Storage;
    use Telegram\Bot\Laravel\Facades\Telegram;


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

    Route::get('send-email', function() {
        // return view('form.sendEmailForm');

        $updates = Telegram::getUpdates();
        $telegramChatId = null;
        $userName = "anastasiaxo";
        foreach ($updates as $update) {
            $telegramUserName = $update['message']['chat']['username'];
            if($userName == $telegramUserName) {
                $telegramChatId = $update['message']['chat']['id'];
                $response = Telegram::sendMessage([
                    'chat_id' => $telegramChatId,
                    'text' => 'Hello World'
                ]);
                break;
            }
        }

        return dump($response);


        $response = Telegram::sendMessage([
                'chat_id' => "@anastasiaxo",
                'text' => 'Hello World'
        ]);
        return dump($response);
        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();

        dump($botId);
        dump($username);

    });

    Route::post('message-send', function() {
        $email = $_REQUEST['email'];
        \App\Events\WelcomeEvent::dispatch($email);
        return view('auth.welcome', compact('email'));
    })->name('welcomeMail');


    Route::get('test2', function () {
//        $response = Http::post('https://translation.googleapis.com/language/translate/v2', [
//            'query' => [
//                "q" => "The Great Pyramid of Giza (also known as the Pyramid of Khufu or the Pyramid of Cheops) is the oldest and largest of the three pyramids in the Giza pyramid complex.",
//                "source" => "en",
//                "target" => "es",
//                "format" => "text"
//            ]
//        ]);

        $response = Http::get('api.openweathermap.org/data/2.5/weather', [
            'query' => [
                'q' => 'London',
                'appid' => '763120c2bd87ded895f42466d8788150',
                'lang' => 'ru'
            ]
        ]);
        dump($response->object());
    });

    Route::get('test', function () {
//        \App\Jobs\BingoJob::dispatch()->onQueue('delay')->delay(now()->addMinutes(1));
//        \App\Jobs\BingoJob::dispatch()->onQueue('no delay');

//        $client = new \GuzzleHttp\Client([
//            'base_uri' => 'https://www.nbrb.by'
//        ]);
//        $response = $client->get('api/exrates/rates/145', [
//            'query' => [
//                'ondate' => '2021-1-1',
//                'periodicity' => 0
//            ]
//        ]);
//        $curr = json_decode($response->getBody()->getContents());
//        dump($curr);
//
////        $client->post('https://www.nbrb.by/api/exrates/rates/145', [
////            'formParams' => [
////                'Cur_ID' => 145,
////                'Cur_RATE' => 5
////            ]
////        ]);
//
//        $curr = $client->request('GET', 'https://www.nbrb.by/api/exrates/rates/145',
//        ['query' => [
//            'ondate' => '2021-1-1',
//            'periodicity' => 0
//        ]]);

        $response = Http::get('https://www.nbrb.by/api/exrates/rates/145?ondate=2016-4-13&periodicity=0');
        $response = Http::get('https://www.nbrb.by/api/exrates/rates/145', [
            'query' => [
                'ondate' => '2020-1-1',
                'periodicity' => 0
            ]
        ]);
        dump($response->body());

        Http::asForm()->post('', []);
        Http::asJson()->post('', []);

    });


Route::get('test-el', function () {

    dd(Product::find(1)->brand());
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
