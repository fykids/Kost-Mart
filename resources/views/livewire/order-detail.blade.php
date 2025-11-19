<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <!-- Order Header -->
        <div class="flex justify-between items-start mb-6 pb-6 border-b">
            <div>
                <h1 class="text-3xl font-bold">{{ $order->order_number }}</h1>
                <p class="text-gray-600">{{ $order->created_at->format('d F Y H:i') }}</p>
            </div>
            
            <span class="px-4 py-2 rounded-full text-white font-semibold text-lg
                @if($order->status === 'pending') bg-yellow-500
                @elseif($order->status === 'paid') bg-blue-500
                @elseif($order->status === 'shipped') bg-purple-500
                @elseif($order->status === 'delivered') bg-green-500
                @else bg-red-500
                @endif
            ">
                {{ $statusLabel }}
            </span>
        </div>

        <!-- Progress Timeline -->
        <div class="mb-8 pb-8 border-b">
            <div class="flex justify-between">
                <div class="flex flex-col items-center
                    @if(in_array($order->status, ['pending', 'paid', 'shipped', 'delivered'])) text-blue-600 @else text-gray-400 @endif
                ">
                    <div class="w-8 h-8 rounded-full border-2 border-current flex items-center justify-center">✓</div>
                    <p class="text-xs mt-1 text-center">Pending</p>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mt-4 mx-2
                    @if(in_array($order->status, ['paid', 'shipped', 'delivered'])) bg-blue-600 @endif
                "></div>
                <div class="flex flex-col items-center
                    @if(in_array($order->status, ['paid', 'shipped', 'delivered'])) text-blue-600 @else text-gray-400 @endif
                ">
                    <div class="w-8 h-8 rounded-full border-2 border-current flex items-center justify-center">
                        @if(in_array($order->status, ['paid', 'shipped', 'delivered'])) ✓ @endif
                    </div>
                    <p class="text-xs mt-1 text-center">Dibayar</p>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mt-4 mx-2
                    @if(in_array($order->status, ['shipped', 'delivered'])) bg-blue-600 @endif
                "></div>
                <div class="flex flex-col items-center
                    @if(in_array($order->status, ['shipped', 'delivered'])) text-blue-600 @else text-gray-400 @endif
                ">
                    <div class="w-8 h-8 rounded-full border-2 border-current flex items-center justify-center">
                        @if(in_array($order->status, ['shipped', 'delivered'])) ✓ @endif
                    </div>
                    <p class="text-xs mt-1 text-center">Dikirim</p>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mt-4 mx-2
                    @if($order->status === 'delivered') bg-blue-600 @endif
                "></div>
                <div class="flex flex-col items-center
                    @if($order->status === 'delivered') text-blue-600 @else text-gray-400 @endif
                ">
                    <div class="w-8 h-8 rounded-full border-2 border-current flex items-center justify-center">
                        @if($order->status === 'delivered') ✓ @endif
                    </div>
                    <p class="text-xs mt-1 text-center">Tiba</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Produk Pesanan</h2>
            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-start p-4 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-bold">{{ $item->product->name }}</h3>
                            <p class="text-gray-600 text-sm">Rp{{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}</p>
                        </div>
                        <p class="font-bold text-lg">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Order Summary -->
        <div class="mb-8 pb-8 border-b">
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span>Gratis</span>
                </div>
            </div>
            <div class="flex justify-between text-lg font-bold mt-4 pt-4">
                <span>Total</span>
                <span class="text-blue-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Shipping & Payment Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Shipping Address -->
            <div>
                <h3 class="font-bold text-lg mb-2">Alamat Pengiriman</h3>
                <p class="text-gray-700">{{ $order->shipping_address }}</p>
            </div>

            <!-- Payment Method -->
            <div>
                <h3 class="font-bold text-lg mb-2">Metode Pembayaran</h3>
                <p class="text-gray-700">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
            </div>
        </div>

        <!-- Notes -->
        @if($order->notes)
            <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                <h3 class="font-bold mb-2">Catatan Pesanan</h3>
                <p class="text-gray-700">{{ $order->notes }}</p>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex gap-2 pt-6 border-t">
            <a 
                href="{{ route('orders.index') }}"
                class="flex-1 bg-gray-600 text-white text-center py-2 rounded-lg hover:bg-gray-700 transition"
            >
                Kembali ke Pesanan
            </a>

            @if($canPayment)
                <button 
                    wire:click="markAsPaid"
                    class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition"
                >
                    Tandai Dibayar
                </button>
            @endif

            @if($canCancel)
                <button 
                    wire:click="cancelOrder"
                    onclick="confirm('Apakah Anda yakin ingin membatalkan pesanan ini?') || event.stopImmediatePropagation()"
                    class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition"
                >
                    Batalkan
                </button>
            @endif
        </div>
    </div>
</div>
