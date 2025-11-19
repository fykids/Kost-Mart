@extends('layouts.app')

@section('title', 'Produk Saya - Kost Mart Seller')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4">
        @livewire('seller.product-list')
    </div>
</div>
@endsection
