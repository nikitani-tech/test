<?php

declare(strict_types=1);

namespace Database\Seeders;


use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $productsCount, bool $addImage): void
    {
        $faker = Faker::create();
        $randomImageUrl = "https://picsum.photos/600/400";
        for ($i = 0; $i < $productsCount; $i++) {
            $productName = ucwords($faker->words(3, true));
            $product = Product::create([
                'author_id' => 1,
                'product_name' => $productName,
                'slug' => Str::slug($productName),
                'sku' => strtoupper(Str::slug($productName)) . '-' . rand(100, 999),
                'price' => $faker->randomFloat(2, 10, 500),
                'description' => $faker->text(),
                'stock' => $faker->numberBetween(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($addImage)
            {
                $product->addMediaFromUrl($randomImageUrl)->toMediaCollection('product_image');
            }
        }
    }
}
