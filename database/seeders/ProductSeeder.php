<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Makanan & Minuman (seller 1)
        Product::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Indomie Goreng',
            'description' => 'Mie instan rasa goreng yang enak dan mengenyangkan',
            'price' => 3000,
            'stock' => 50,
            'image' => 'https://unsplash.com/photos/white-and-red-pack-2bFNtULO8iA',
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Kopi Hitam Sachet',
            'description' => 'Kopi premium sachet 25g per pcs',
            'price' => 2500,
            'stock' => 100,
            'image' => 'https://unsplash.com/photos/black-coffee-in-clear-glass-mug-h3ijQ4Z7hXY',
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Snack Keripik Singkong',
            'description' => 'Keripik singkong renyah dan gurih',
            'price' => 15000,
            'stock' => 30,
            'image' => 'https://unsplash.com/photos/crisps-in-white-bowl-6VhPY27jdps',
            'is_active' => true,
        ]);

        // Elektronik (seller 2)
        Product::create([
            'user_id' => 2,
            'category_id' => 3,
            'name' => 'Powerbank 20000mAh',
            'description' => 'Powerbank kapasitas besar dengan fast charging',
            'price' => 150000,
            'stock' => 20,
            'image' => 'https://unsplash.com/photos/white-power-bank-on-blue-surface-PxJ9zkM2wdA',
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => 2,
            'category_id' => 3,
            'name' => 'Kabel Data USB-C',
            'description' => 'Kabel data USB-C berkualitas tinggi panjang 2 meter',
            'price' => 50000,
            'stock' => 45,
            'image' => 'https://unsplash.com/photos/white-usb-c-cable-uYQgO4w0u2w',
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => 2,
            'category_id' => 3,
            'name' => 'Headphone Wireless',
            'description' => 'Headphone bluetooth dengan baterai 12 jam',
            'price' => 250000,
            'stock' => 15,
            'image' => 'https://unsplash.com/photos/black-wireless-headphones-wearing-on-grey-background-Qb7D1xw28Co',
            'is_active' => true,
        ]);

        // Perlengkapan Kamar (seller 1)
        Product::create([
            'user_id' => 1,
            'category_id' => 2,
            'name' => 'Selimut Lembut',
            'description' => 'Selimut micro fleece tebal dan hangat',
            'price' => 80000,
            'stock' => 25,
            'image' => 'https://unsplash.com/photos/folded-brown-fleece-blanket-1byH6CSdEWI',
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => 1,
            'category_id' => 2,
            'name' => 'Bantal Ergonomis',
            'description' => 'Bantal dengan memory foam nyaman untuk tidur',
            'price' => 120000,
            'stock' => 18,
            'image' => 'https://unsplash.com/photos/white-memory-foam-pillow-on-bed-ujq2X5wX1Ak',
            'is_active' => true,
        ]);

        // Kebutuhan Sehari-hari (seller 2)
        Product::create([
            'user_id' => 2,
            'category_id' => 4,
            'name' => 'Sabun Mandi Bar',
            'description' => 'Sabun mandi herbal yang lembut di kulit',
            'price' => 12000,
            'stock' => 60,
            'image' => 'https://unsplash.com/photos/brown-soap-bar-on-white-bath-tub-edge-8manzosRGPE',
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => 2,
            'category_id' => 4,
            'name' => 'Shampo Anti Ketombe',
            'description' => 'Shampo untuk rambut yang rontok dan berketombe',
            'price' => 35000,
            'stock' => 40,
            'image' => 'https://unsplash.com/photos/shampoo-bottle-on-bathroom-floor-CSz7eKiVx4E',
            'is_active' => true,
        ]);
    }
}
