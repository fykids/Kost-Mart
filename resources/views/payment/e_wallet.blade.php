@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow text-center">
        <h2 class="text-2xl font-bold mb-4">Pembayaran E-Wallet</h2>

        <p class="mb-2">Pesanan: <strong>{{ $order->order_number }}</strong></p>
        <p class="mb-2">Jumlah: <strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong></p>

        <div class="my-4">
            <div class="inline-block p-6 bg-gray-50 rounded">
                <p class="text-sm text-gray-600">Scan atau klik untuk membayar melalui E-Wallet</p>
                <pre class="font-mono text-xs bg-white p-2 rounded mt-2">{{ $qr }}</pre>
            </div>
        </div>

        <form method="POST" action="{{ route('payment.confirm', $order->id) }}">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Bayar Sekarang (Simulasi)</button>
            <a href="{{ route('orders.show', $order->id) }}" class="ml-3 text-gray-600">Kembali ke detail pesanan</a>
        </form>
    </div>
</div>
@endsection
