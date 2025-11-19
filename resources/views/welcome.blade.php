@extends('layouts.app')

@section('title', 'Kost Mart - E-Commerce untuk Anak Kost')

@section('content')
<div>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Belanja Mudah, Harga Terjangkau</h1>
            <p class="text-xl mb-8">Platform e-commerce khusus untuk anak kost dengan ribuan produk pilihan</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition">
                    Mulai Belanja
                </a>
                <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-600 transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold mb-8">Kategori Populer</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $categories = [
                    ['name' => '🍜 Makanan', 'slug' => 'makanan'],
                    ['name' => '📱 Elektronik', 'slug' => 'elektronik'],
                    ['name' => '🛏️ Kamar', 'slug' => 'kamar'],
                    ['name' => '🧴 Hygiene', 'slug' => 'hygiene'],
                    ['name' => '👕 Fashion', 'slug' => 'fashion'],
                    ['name' => '📚 Belajar', 'slug' => 'belajar'],
                ];
            @endphp

            @foreach($categories as $category)
                <a href="{{ route('products.index') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-2">{{ explode(' ', $category['name'])[0] }}</div>
                    <p class="font-semibold">{{ $category['name'] }}</p>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 text-center">Mengapa Pilih Kost Mart?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="text-4xl mb-4">🚚</div>
                    <h3 class="font-bold text-lg mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Pengiriman gratis untuk pembelian tertentu</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="text-4xl mb-4">💰</div>
                    <h3 class="font-bold text-lg mb-2">Harga Terbaik</h3>
                    <p class="text-gray-600">Harga kompetitif dengan promo menarik setiap hari</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="text-4xl mb-4">🛡️</div>
                    <h3 class="font-bold text-lg mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Penjual terverifikasi dan pembayaran aman</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="font-bold text-lg mb-2">Customer Service</h3>
                    <p class="text-gray-600">Tim support siap membantu 24/7</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="container mx-auto px-4 py-16">
        <div class="bg-blue-600 text-white rounded-lg shadow-lg p-12 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap untuk Mulai Berbelanja?</h2>
            <p class="text-lg mb-8">Ribuan produk pilihan menunggu Anda dengan harga terbaik</p>
            <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition inline-block">
                Jelajahi Produk Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
