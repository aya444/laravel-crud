<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Product::create([
                'name' => 'Product ' . $i,
                'detail' => 'Product ' . $i . ' detail',
                'price' => rand(100, 1000),
                'quantity' => rand(1, 50),
            ]);
        }
    }
}
