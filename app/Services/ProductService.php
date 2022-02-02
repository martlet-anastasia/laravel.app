<?php

    namespace App\Services;

    use App\Models\Product;

    class ProductService
    {
        public function getProductById($id) {
            return Product::find($id);
        }

    }
