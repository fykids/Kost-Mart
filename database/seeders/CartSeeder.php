<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Customer 1 (Budi) - 3 items di cart
        Cart::create([
            'user_id' => 3,
            'product_id' => 1,
            'quantity' => 5,
        ]);

        Cart::create([
            'user_id' => 3,
            'product_id' => 4,
            'quantity' => 1,
        ]);

        Cart::create([
            'user_id' => 3,
            'product_id' => 7,
            'quantity' => 2,
        ]);

        // Customer 2 (Siti) - 2 items di cart
        Cart::create([
            'user_id' => 4,
            'product_id' => 2,
            'quantity' => 10,
        ]);

        Cart::create([
            'user_id' => 4,
            'product_id' => 9,
            'quantity' => 1,
        ]);

        // Customer 3 (Ahmad) - 1 item di cart
        Cart::create([
            'user_id' => 5,
            'product_id' => 5,
            'quantity' => 3,
        ]);
    }
}
