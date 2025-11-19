<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Kost Mart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Kembali</a>
        
        <div id="order-detail">
            @livewire('order-detail', ['orderId' => $orderId])
        </div>
    </div>
</body>
</html>
