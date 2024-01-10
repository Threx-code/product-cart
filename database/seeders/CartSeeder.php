<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user){
            $cartItems = rand(1, 20);

            for($i = 0; $i < $cartItems; $i++){
                $product = $products->random();
                $quantity = rand(1, 5);

                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'is_removed' => !(($i % 2)),
                ]);
            }
        }
    }
}
