<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Order 1 - Customer 3 (Ahmad)
        $order1 = Order::create([
            'user_id' => 5,
            'order_number' => 'ORD-' . date('Ymd') . '-001',
            'total_price' => 150000,
            'status' => 'delivered',
            'payment_method' => 'cod',
            'shipping_address' => 'Jl. Merdeka No. 10, Kos Room 5, Jakarta Selatan',
            'notes' => 'Tolong diletakkan di depan pintu kos',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => 4,
            'quantity' => 1,
            'price' => 150000,
            'subtotal' => 150000,
        ]);

        // Order 2 - Customer 4 (Siti)
        $order2 = Order::create([
            'user_id' => 4,
            'order_number' => 'ORD-' . date('Ymd') . '-002',
            'total_price' => 50000,
            'status' => 'shipped',
            'payment_method' => 'transfer',
            'shipping_address' => 'Kos Bunga Melati No. 12, Jl. Gatot Subroto, Bandung',
            'notes' => null,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => 5,
            'quantity' => 1,
            'price' => 50000,
            'subtotal' => 50000,
        ]);

        // Order 3 - Customer 3 (Ahmad)
        $order3 = Order::create([
            'user_id' => 5,
            'order_number' => 'ORD-' . date('Ymd') . '-003',
            'total_price' => 105000,
            'status' => 'paid',
            'payment_method' => 'e_wallet',
            'shipping_address' => 'Jl. Merdeka No. 10, Kos Room 5, Jakarta Selatan',
            'notes' => null,
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => 2,
            'quantity' => 2,
            'price' => 2500,
            'subtotal' => 5000,
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => 10,
            'quantity' => 3,
            'price' => 35000,
            'subtotal' => 105000,
        ]);

        // Order 4 - Customer 2 (Budi)
        $order4 = Order::create([
            'user_id' => 3,
            'order_number' => 'ORD-' . date('Ymd') . '-004',
            'total_price' => 95000,
            'status' => 'pending',
            'payment_method' => 'cod',
            'shipping_address' => 'Kos Sejahtera No. 5, Jl. Ahmad Yani, Surabaya',
            'notes' => 'Hubungi nomor di atas sebelum datang',
        ]);

        OrderItem::create([
            'order_id' => $order4->id,
            'product_id' => 3,
            'quantity' => 1,
            'price' => 15000,
            'subtotal' => 15000,
        ]);

        OrderItem::create([
            'order_id' => $order4->id,
            'product_id' => 8,
            'quantity' => 1,
            'price' => 120000,
            'subtotal' => 120000,
        ]);
    }
}
