<div>
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">🏪 Dashboard Penjual</h1>
            <p class="text-gray-600 mt-2">Kelola dan pantau produk yang Anda jual</p>
        </div>
        <a 
            href="{{ route('seller.products.create') }}"
            class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg transition shadow-md flex items-center gap-2"
        >
            ➕ Tambah Produk Baru
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 text-sm font-medium">Total Produk</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $products->total() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 text-sm font-medium">Produk Aktif</p>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $products->where('is_active', true)->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 text-sm font-medium">Stok Rendah (&lt;5)</p>
            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $products->where('stock', '<', 5)->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 text-sm font-medium">Pengaturan Akun</p>
            <a href="{{ route('settings.account') }}" class="text-blue-600 hover:text-blue-800 font-semibold mt-2 inline-block">
                ⚙️ Lihat →
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-6 bg-white rounded-lg shadow-md p-4">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="🔍 Cari produk berdasarkan nama atau deskripsi..."
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
        >
    </div>

    <!-- Products Table -->
    @if($products->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left">
                            <button wire:click="setSortBy('name')" class="font-semibold text-gray-700 hover:text-blue-600 flex items-center gap-1">
                                📦 Nama Produk
                                @if($sortBy === 'name')
                                    <span class="text-blue-600">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <button wire:click="setSortBy('price')" class="font-semibold text-gray-700 hover:text-blue-600 flex items-center gap-1">
                                💰 Harga
                                @if($sortBy === 'price')
                                    <span class="text-blue-600">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <button wire:click="setSortBy('stock')" class="font-semibold text-gray-700 hover:text-blue-600 flex items-center gap-1">
                                📊 Stok
                                @if($sortBy === 'stock')
                                    <span class="text-blue-600">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <button wire:click="setSortBy('created_at')" class="font-semibold text-gray-700 hover:text-blue-600 flex items-center gap-1">
                                📅 Dibuat
                                @if($sortBy === 'created_at')
                                    <span class="text-blue-600">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">🔴 Status</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">⚡ Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-600">{{ $product->category->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $product->stock > 5 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $product->stock }} unit
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $product->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <button 
                                    wire:click="toggleActive({{ $product->id }})"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition cursor-pointer {{ $product->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}"
                                >
                                    {{ $product->is_active ? '✅ Aktif' : '❌ Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a 
                                        href="{{ route('seller.products.edit', $product->id) }}"
                                        class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium transition text-sm"
                                    >
                                        ✏️ Edit
                                    </a>
                                    <button 
                                        wire:click="deleteProduct({{ $product->id }})"
                                        onclick="confirm('Apakah Anda yakin ingin menghapus produk ini?') || event.stopImmediatePropagation()"
                                        class="px-3 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 font-medium transition text-sm"
                                    >
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $products->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-16 text-center">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Produk</h3>
            <p class="text-gray-600 mb-6">Mulai jual sekarang dengan menambahkan produk pertama Anda!</p>
            <a 
                href="{{ route('seller.products.create') }}"
                class="bg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-700 transition inline-block"
            >
                ➕ Buat Produk Pertama
            </a>
        </div>
    @endif
</div>
