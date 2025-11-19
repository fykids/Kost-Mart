@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Instruksi Pembayaran - Transfer Bank</h2>

        <p class="mb-2">Pesanan: <strong>{{ $order->order_number }}</strong></p>
        <p class="mb-2">Jumlah yang harus dibayar: <strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong></p>

        <div class="bg-gray-50 p-4 rounded mb-4">
            <p><strong>Bank:</strong> {{ $bank }}</p>
            <p><strong>Nomor VA:</strong> <span class="font-mono">{{ $va }}</span></p>
            <p class="text-sm text-gray-600 mt-2">Silakan transfer jumlah yang tertera ke rekening di atas. Setelah transfer, tekan tombol "Saya sudah transfer" untuk mengonfirmasi.</p>
        </div>

        <form method="POST" action="{{ route('payment.confirm', $order->id) }}">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Saya sudah transfer</button>
            <a href="{{ route('orders.show', $order->id) }}" class="ml-3 text-gray-600">Kembali ke detail pesanan</a>
        </form>
    </div>
</div>
@endsection
