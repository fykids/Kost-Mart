<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-500 text-lg mb-4">Keranjang belanja Anda kosong</p>
            <a href="/products" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition inline-block">
                Lanjut Belanja
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md">
                    @foreach($cartItems as $item)
                        <div class="flex gap-4 p-6 border-b last:border-b-0">
                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <span class="text-gray-500 text-sm">No Image</span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-grow">
                                <h3 class="font-bold text-lg">{{ $item->product->name }}</h3>
                                <p class="text-gray-600">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                                
                                <!-- Quantity Control -->
                                <div class="flex items-center gap-2 mt-2">
                                    <button 
                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition"
                                    >
                                        -
                                    </button>
                                    <span class="w-8 text-center">{{ $item->quantity }}</span>
                                    <button 
                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>

                            <!-- Subtotal & Remove -->
                            <div class="text-right">
                                <p class="font-bold text-lg">Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                <button 
                                    wire:click="removeItem({{ $item->id }})"
                                    class="text-red-600 hover:text-red-800 mt-2 text-sm"
                                >
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button 
                        wire:click="clearCart"
                        onclick="confirm('Apakah Anda yakin?') || event.stopImmediatePropagation()"
                        class="text-red-600 hover:text-red-800 font-semibold"
                    >
                        Kosongkan Keranjang
                    </button>
                </div>
            </div>

            <!-- Summary -->
            <div class="bg-white rounded-lg shadow-md p-6 h-fit">
                <h2 class="text-2xl font-bold mb-4">Ringkasan</h2>
                
                <div class="space-y-2 mb-4 pb-4 border-b">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-semibold">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ongkir</span>
                        <span class="font-semibold">Gratis</span>
                    </div>
                </div>

                <div class="flex justify-between mb-6 text-lg font-bold">
                    <span>Total</span>
                    <span class="text-blue-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a 
                    href="/checkout"
                    class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition font-semibold"
                >
                    Lanjut ke Checkout
                </a>
            </div>
        </div>
    @endif
</div>
