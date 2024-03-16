<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
        ->has(Item::factory()
        ->has(Product::factory()
        ->count(20), 'products' )
        ->count(15) , 'items')
        ->count(2)
        ->create();
    }
}
