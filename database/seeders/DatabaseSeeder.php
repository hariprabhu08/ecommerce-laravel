<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create(['title' => 'test data1',
                        'content' => 'test content1',
                        'price' => rand(0,300),
                        'quantity' => 20]);
        Product::create(['title' => 'test data2',
                        'content' => 'test content2',
                        'price' => rand(0,300),
                        'quantity' => 20]);
        Product::create(['title' => 'test data3',
                        'content' => 'test content3',
                        'price' => rand(0,300),
                        'quantity' => 20]);
        $this->call(ProductSeeder::class);
        $this->command->info('generate constant data');
    }
}
