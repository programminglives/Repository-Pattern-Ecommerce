<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        \Illuminate\Support\Facades\DB::table('categories')->insert([
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => $faker->text,
                'active' => 1,
                'order' => 1,
                'meta_title' => 'food',
                'meta_description' => 'food',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Drinks',
                'slug' => 'drinks',
                'description' => $faker->text,
                'active' => 1,
                'order' => 2,
                'meta_title' => 'drinks',
                'meta_description' => 'drinks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Snacks',
                'slug' => 'snacks',
                'description' => $faker->text,
                'active' => 1,
                'order' => 3,
                'meta_title' => 'snacks',
                'meta_description' => 'snacks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Alcohol',
                'slug' => 'alcohol',
                'description' => $faker->text,
                'active' => 1,
                'order' => 4,
                'meta_title' => 'alcohol',
                'meta_description' => 'alcohol',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        $categories = \App\Models\Category::all();
        \App\Models\Product::all()->each(function($product) use ($categories){
            $product->categories()->attach(
                $categories->random(rand(1,$categories->count()))->pluck('id')->toArray()
            );
        });

    }
}
