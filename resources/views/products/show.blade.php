@extends('layouts.app')

@section('title', 'Detail Produk - Kost Mart')

@section('content')
    @livewire('product-detail', ['productId' => $productId])
@endsection
