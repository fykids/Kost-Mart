<div>
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">✏️ Edit Produk</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi produk Anda</p>
    </div>

    <form wire:submit="updateProduct" class="bg-white rounded-lg shadow-md p-8 space-y-8">
        <!-- Basic Info Section -->
        <div class="border-b pb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Dasar</h2>
            
            <!-- Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">📝 Nama Produk <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    wire:model="name" 
                    placeholder="Contoh: Kamar Kost Nyaman dengan AC"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
                @error('name')
                    <span class="text-red-500 text-sm mt-2 block">❌ {{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">📄 Deskripsi Produk <span class="text-red-500">*</span></label>
                <textarea 
                    wire:model="description" 
                    rows="5"
                    placeholder="Jelaskan detail dan keunggulan produk Anda..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                ></textarea>
                @error('description')
                    <span class="text-red-500 text-sm mt-2 block">❌ {{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">🏷️ Kategori <span class="text-red-500">*</span></label>
                <select 
                    wire:model="category_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm mt-2 block">❌ {{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Pricing & Stock Section -->
        <div class="border-b pb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">💰 Harga & Stok</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input 
                        type="number" 
                        wire:model="price" 
                        placeholder="Contoh: 1500000"
                        min="1000"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('price')
                        <span class="text-red-500 text-sm mt-2 block">❌ {{ $message }}</span>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">📊 Stok (Unit) <span class="text-red-500">*</span></label>
                    <input 
                        type="number" 
                        wire:model="stock" 
                        placeholder="Contoh: 5"
                        min="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('stock')
                        <span class="text-red-500 text-sm mt-2 block">❌ {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Image Section -->
        <div class="border-b pb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">🖼️ Gambar Produk</h2>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL Gambar <span class="text-red-500">*</span></label>
                <input 
                    type="url" 
                    wire:model="image" 
                    placeholder="https://unsplash.com/photos/..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
                @error('image')
                    <span class="text-red-500 text-sm mt-2 block">❌ {{ $message }}</span>
                @enderror
                <p class="text-gray-500 text-sm mt-3">💡 Gunakan URL dari <a href="https://unsplash.com" target="_blank" class="text-blue-600 hover:underline">Unsplash</a> atau situs gambar gratis lainnya</p>
            </div>
        </div>

        <!-- Status Section -->
        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
            <h2 class="text-xl font-bold text-gray-900 mb-6">🔴 Status Produk</h2>
            
            <label class="flex items-center gap-3 cursor-pointer">
                <input 
                    type="checkbox" 
                    wire:model="is_active"
                    class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition"
                >
                <span class="font-medium text-gray-700">Produk Aktif & Tersedia untuk Dibeli</span>
            </label>
            <p class="text-sm text-gray-600 mt-3">Nonaktifkan untuk menyembunyikan produk dari pembeli tanpa menghapusnya</p>
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-4">
            <button 
                type="submit" 
                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-lg font-bold hover:shadow-lg transition shadow-md"
            >
                💾 Simpan Perubahan
            </button>
            <a 
                href="{{ route('seller.products.index') }}"
                class="flex-1 bg-gray-200 text-gray-800 px-6 py-4 rounded-lg font-medium hover:bg-gray-300 transition text-center"
            >
                ✕ Batal
            </a>
        </div>
    </form>
</div>
