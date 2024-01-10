<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(ProductData::PRODUCTS as $product){
            $this->insertProduct($product['name'], $product['price']);
        }

        $faker = Faker::create();
        for($i = 0; $i < 20; $i++){
            $this->insertProduct($faker->word, $faker->randomFloat(2, 1, 100));
        }
    }

    /**
     * @param $name
     * @param $price
     * @return void
     */
    public function insertProduct($name, $price): void
    {
        Product::create([
            'name' => $name,
            'price' => $price
        ]);
    }
}
