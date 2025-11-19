@extends('layouts.app')

@section('title', 'Edit Produk - Kost Mart Seller')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        @livewire('seller.product-edit', ['productId' => $productId])
    </div>
</div>
@endsection
