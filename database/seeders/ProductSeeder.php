<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::upsert([
            ['id' => 6,
            'title' => 'constant data',
            'content' => 'constant content',
            'price' => rand(0,300),
            'quantity' => 20],
            ['id' => 7,
            'title' => 'constant data',
            'content' => 'constant content',
            'price' => rand(0,300),
            'quantity' => 20]
        ], ['id'], ['price', 'quantity']);
    }
}
