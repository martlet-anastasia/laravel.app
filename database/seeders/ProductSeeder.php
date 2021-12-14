<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->select('*')->get();

//        for($i=1; $i < 100; $i++) {
//            DB::table('products')->insert(
//                [
//                    'name' => 'Product name '.$i,
//                    'price' => $i * 100,
//                ]);
//        }

//        Product::factory()
//            ->count(50)->create([
//                'name' => 'ololo',
//                'price' => 35353535,
//                'status' => false,
//            ]);

        Product::factory()
            ->count(50)->create();
    }
}
