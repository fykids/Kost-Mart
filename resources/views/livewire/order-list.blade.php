<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">Pesanan Saya</h1>

    <!-- Statistics -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-gray-600 text-sm">Total</p>
            <p class="text-2xl font-bold">{{ $stats['total'] ?? 0 }}</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow-md p-4 text-center">
            <p class="text-gray-600 text-sm">Pending</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] ?? 0 }}</p>
        </div>
        <div class="bg-blue-50 rounded-lg shadow-md p-4 text-center">
            <p class="text-gray-600 text-sm">Dibayar</p>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['paid'] ?? 0 }}</p>
        </div>
        <div class="bg-purple-50 rounded-lg shadow-md p-4 text-center">
            <p class="text-gray-600 text-sm">Dikirim</p>
            <p class="text-2xl font-bold text-purple-600">{{ $stats['shipped'] ?? 0 }}</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow-md p-4 text-center">
            <p class="text-gray-600 text-sm">Tiba</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['delivered'] ?? 0 }}</p>
        </div>
        <div class="bg-red-50 rounded-lg shadow-md p-4 text-center">
            <p class="text-gray-600 text-sm">Dibatalkan</p>
            <p class="text-2xl font-bold text-red-600">{{ $stats['cancelled'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Status Filter -->
    <div class="mb-6">
        <select 
            wire:model.live="status"
            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="">Semua Status ({{ $totalOrders ?? 0 }})</option>
            <option value="pending">Pending ({{ $stats['pending'] ?? 0 }})</option>
            <option value="paid">Dibayar ({{ $stats['paid'] ?? 0 }})</option>
            <option value="shipped">Dikirim ({{ $stats['shipped'] ?? 0 }})</option>
            <option value="delivered">Tiba ({{ $stats['delivered'] ?? 0 }})</option>
            <option value="cancelled">Dibatalkan ({{ $stats['cancelled'] ?? 0 }})</option>
        </select>
    </div>

    @if($orders->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-500 text-lg mb-4">Anda belum memiliki pesanan</p>
            <a href="/products" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition inline-block">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-start mb-4 pb-4 border-b">
                        <div>
                            <h3 class="font-bold text-lg">{{ $order->order_number }}</h3>
                            <p class="text-gray-600 text-sm">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        
                        <!-- Status Badge -->
                        <span class="px-3 py-1 rounded-full text-white text-sm font-semibold
                            @if($order->status === 'pending') bg-yellow-500
                            @elseif($order->status === 'paid') bg-blue-500
                            @elseif($order->status === 'shipped') bg-purple-500
                            @elseif($order->status === 'delivered') bg-green-500
                            @else bg-red-500
                            @endif
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <!-- Order Items Preview -->
                    <div class="mb-4 pb-4 border-b">
                        <p class="text-sm text-gray-600 mb-2">{{ $order->items->count() }} item</p>
                        @foreach($order->items->take(2) as $item)
                            <div class="text-sm">
                                {{ $item->product->name }} x{{ $item->quantity }}
                            </div>
                        @endforeach
                        @if($order->items->count() > 2)
                            <div class="text-sm text-gray-500">+{{ $order->items->count() - 2 }} item lainnya</div>
                        @endif
                    </div>

                    <!-- Order Info -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Metode:</span>
                                <p class="font-semibold">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-gray-600">Total:</span>
                                <p class="font-bold text-lg text-blue-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <a 
                            href="/orders/{{ $order->id }}"
                            class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition font-semibold"
                        >
                            Lihat Detail
                        </a>
                        
                        @if(in_array($order->status, ['pending', 'paid']))
                            <button 
                                wire:click="cancelOrder({{ $order->id }})"
                                onclick="confirm('Apakah Anda yakin ingin membatalkan pesanan ini?') || event.stopImmediatePropagation()"
                                class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold"
                            >
                                Batalkan
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="flex justify-center mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    @endif
</div>
