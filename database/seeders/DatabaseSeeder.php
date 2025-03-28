<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Product::factory(10)->create();

        $this->call(ProductSeeder::class);
    }
}
