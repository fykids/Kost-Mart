<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- Product Image -->
        <div>
            <div class="bg-gray-200 rounded-lg h-96 flex items-center justify-center">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-500">No Image</span>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div>
            <h1 class="text-4xl font-bold mb-2">{{ $product->name }}</h1>
            
            <!-- Rating -->
            @if($avgRating)
                <div class="flex items-center gap-2 mb-4">
                    <div class="flex text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgRating))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <span class="text-gray-600">({{ $reviews->count() }} ulasan)</span>
                </div>
            @endif

            <p class="text-gray-600 mb-6">{{ $product->description }}</p>

            <!-- Price & Stock -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <div class="text-3xl font-bold text-blue-600 mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="text-sm text-gray-600">
                    Stok Tersedia: <span class="font-bold">{{ $product->stock }}</span>
                </div>
            </div>

            <!-- Quantity Selector -->
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2">Jumlah:</label>
                <div class="flex items-center gap-2">
                    <button 
                        wire:click="decreaseQuantity"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition"
                    >
                        -
                    </button>
                    <input 
                        type="number" 
                        wire:model="quantity"
                        min="1"
                        max="{{ $product->stock }}"
                        class="w-16 text-center px-3 py-2 border rounded-lg"
                    >
                    <button 
                        wire:click="increaseQuantity"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition"
                    >
                        +
                    </button>
                </div>
            </div>

            <!-- Add to Cart Button -->
            <button 
                wire:click="addToCart"
                @if($product->stock == 0) disabled @endif
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition disabled:bg-gray-400"
            >
                @if($product->stock == 0)
                    Stok Habis
                @else
                    Tambah ke Keranjang
                @endif
            </button>

            <!-- Product Meta -->
            <div class="mt-8 pt-8 border-t">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Penjual:</span>
                        <p class="font-semibold">{{ $product->user->name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600">Kategori:</span>
                        <p class="font-semibold">{{ $product->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div>
        <h2 class="text-2xl font-bold mb-6">Ulasan Produk ({{ $reviews->count() }})</h2>
        
        @if($reviews->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <p class="text-gray-500">Belum ada ulasan untuk produk ini</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold">{{ $review->user->name }}</p>
                                <div class="text-yellow-400 text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <span class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
