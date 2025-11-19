<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Makanan & Minuman',
            'description' => 'Makanan siap saji, snack, minuman, dan camilan lainnya',
        ]);

        Category::create([
            'name' => 'Perlengkapan Kamar',
            'description' => 'Bedding, bantal, selimut, dan perlengkapan kamar lainnya',
        ]);

        Category::create([
            'name' => 'Elektronik',
            'description' => 'Gadget, charger, power bank, dan elektronik lainnya',
        ]);

        Category::create([
            'name' => 'Kebutuhan Sehari-hari',
            'description' => 'Sabun, shampo, pasta gigi, dan kebutuhan personal care',
        ]);

        Category::create([
            'name' => 'Gaya Hidup',
            'description' => 'Fashion, aksesori, tas, dan barang-barang lifestyle',
        ]);

        Category::create([
            'name' => 'Peralatan Belajar',
            'description' => 'Buku, alat tulis, dan perlengkapan belajar lainnya',
        ]);
    }
}
