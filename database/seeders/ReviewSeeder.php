<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Review untuk Product 1 (Indomie)
        Review::create([
            'product_id' => 1,
            'user_id' => 3,
            'rating' => 5,
            'comment' => 'Indomienya enak dan cepat sampai! Packing rapi.',
        ]);

        Review::create([
            'product_id' => 1,
            'user_id' => 4,
            'rating' => 4,
            'comment' => 'Bagus, harga masuk akal untuk anak kos.',
        ]);

        // Review untuk Product 2 (Kopi)
        Review::create([
            'product_id' => 2,
            'user_id' => 5,
            'rating' => 5,
            'comment' => 'Kopinya nikmat dan praktis untuk dibawa kemana-mana.',
        ]);

        // Review untuk Product 4 (Powerbank)
        Review::create([
            'product_id' => 4,
            'user_id' => 5,
            'rating' => 5,
            'comment' => 'Powerbank bagus, kapasitas besar dan charger cepat. Recommend!',
        ]);

        // Review untuk Product 5 (Kabel USB-C)
        Review::create([
            'product_id' => 5,
            'user_id' => 4,
            'rating' => 4,
            'comment' => 'Kabel awet dan charging bagus, tapi packaging bisa lebih bagus.',
        ]);

        // Review untuk Product 8 (Bantal)
        Review::create([
            'product_id' => 8,
            'user_id' => 3,
            'rating' => 5,
            'comment' => 'Bantal empuk dan nyaman, langsung tidur pulas!',
        ]);

        // Review untuk Product 9 (Sabun)
        Review::create([
            'product_id' => 9,
            'user_id' => 4,
            'rating' => 4,
            'comment' => 'Sabunnya lembut, tidak mengeringkan kulit.',
        ]);

        // Review untuk Product 10 (Shampo)
        Review::create([
            'product_id' => 10,
            'user_id' => 5,
            'rating' => 5,
            'comment' => 'Shamponya bekerja, rambut tidak rontok lagi. Puas!',
        ]);
    }
}
