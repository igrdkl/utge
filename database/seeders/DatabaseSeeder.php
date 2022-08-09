<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Price;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\CategoryProduct;
use App\Models\ProductSubCategory;
use App\Models\ProductType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

// use Database\Factories\CategoryProductFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ProductType::factory()->count(10)->create();
        Category::factory()->count(10)->for(ProductType::factory()->create())->create();
        SubCategory::factory()->count(10)->for(Category::factory()->create())->create();
        Product::factory()->count(10)->has(Media::factory()->count(1))->create();

    }
}
