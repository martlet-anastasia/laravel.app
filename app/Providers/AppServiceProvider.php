<?php

namespace App\Providers;

use App\Console\Contracts\ProductServiceInterface;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        ProductResource::wrap('product');
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        ProductResource::withoutWrapping(); // удаляет вложенность в ответе json
    }
}
