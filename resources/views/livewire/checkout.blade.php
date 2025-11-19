<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form wire:submit="processCheckout" class="space-y-6">
                <!-- Shipping Address -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Alamat Pengiriman</h2>
                    
                    <textarea 
                        wire:model="shippingAddress"
                        placeholder="Masukkan alamat lengkap pengiriman..."
                        rows="4"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                    @error('shippingAddress')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Metode Pembayaran</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input 
                                type="radio" 
                                name="paymentMethod" 
                                value="cod"
                                wire:model="paymentMethod"
                                class="w-4 h-4"
                            >
                            <span>
                                <div class="font-semibold">Bayar di Tempat (COD)</div>
                                <div class="text-gray-600 text-sm">Bayar saat barang diterima</div>
                            </span>
                        </label>

                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input 
                                type="radio" 
                                name="paymentMethod" 
                                value="transfer"
                                wire:model="paymentMethod"
                                class="w-4 h-4"
                            >
                            <span>
                                <div class="font-semibold">Transfer Bank</div>
                                <div class="text-gray-600 text-sm">Transfer ke rekening toko</div>
                            </span>
                        </label>

                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input 
                                type="radio" 
                                name="paymentMethod" 
                                value="e_wallet"
                                wire:model="paymentMethod"
                                class="w-4 h-4"
                            >
                            <span>
                                <div class="font-semibold">E-Wallet</div>
                                <div class="text-gray-600 text-sm">Gopay, OVO, Dana, dll</div>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Catatan Pesanan (Opsional)</h2>
                    
                    <textarea 
                        wire:model="notes"
                        placeholder="Contoh: Tolong diletakkan di depan pintu kos..."
                        rows="3"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition"
                >
                    Buat Pesanan
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-lg shadow-md p-6 h-fit">
            <h2 class="text-xl font-bold mb-4">Ringkasan Pesanan</h2>
            
            <div class="space-y-3 mb-4 pb-4 border-b max-h-64 overflow-y-auto">
                @foreach($cartItems as $item)
                    <div class="flex justify-between text-sm">
                        <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

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

            <div class="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span class="text-blue-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
