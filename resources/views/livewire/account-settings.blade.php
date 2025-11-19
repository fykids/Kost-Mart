<div>
    <form wire:submit="updateProfile" class="space-y-8">
        <!-- Profile Section -->
        <div id="profile" class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Profil</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input 
                        type="text" 
                        wire:model="name" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input 
                        type="text" 
                        wire:model="phone" 
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('phone')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    wire:model="email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- User Type -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm font-medium text-gray-700">Tipe Akun</p>
                <p class="text-blue-700 font-semibold mt-1">
                    {{ auth()->user()->role === 'seller' ? '🏪 Akun Penjual' : '👤 Akun Pembeli' }}
                </p>
            </div>
        </div>

        <!-- Password Section -->
        <div id="password" class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Ubah Password</h2>
            <p class="text-gray-600 text-sm mb-6">Biarkan kosong jika tidak ingin mengubah password</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                    <input 
                        type="password" 
                        wire:model="currentPassword" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('currentPassword')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <input 
                        type="password" 
                        wire:model="newPassword" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('newPassword')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input 
                        type="password" 
                        wire:model="newPasswordConfirm" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('newPasswordConfirm')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div id="security" class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Keamanan & Privasi</h2>
            
            <div class="space-y-4">
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="font-medium text-yellow-800 mb-2">🔐 Rekomendasi Keamanan</p>
                    <ul class="text-sm text-yellow-700 space-y-1">
                        <li>✓ Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol</li>
                        <li>✓ Jangan bagikan password Anda kepada siapa pun</li>
                        <li>✓ Perbarui password secara berkala untuk keamanan maksimal</li>
                        <li>✓ Logout dari perangkat bersama setelah selesai</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Seller Info Section (if seller) -->
        @if(auth()->user()->role === 'seller')
        <div id="seller-info" class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Penjual</h2>
            
            <div class="p-4 bg-purple-50 border border-purple-200 rounded-lg">
                <p class="font-medium text-purple-800 mb-2">🏪 Status Penjual</p>
                <p class="text-purple-700 text-sm">Anda terdaftar sebagai penjual di Kost Mart</p>
                <a href="{{ route('seller.products.index') }}" class="inline-block mt-3 text-purple-600 hover:text-purple-800 font-medium underline">
                    → Kelola Produk Anda
                </a>
            </div>
        </div>
        @endif

        <!-- Submit Button -->
        <div class="flex gap-4 pt-4 bg-white rounded-lg shadow-md p-8">
            <button 
                type="submit" 
                class="bg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-700 transition shadow-md hover:shadow-lg"
            >
                💾 Simpan Perubahan
            </button>
            <a 
                href="{{ route('products.index') }}"
                class="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition"
            >
                ✕ Batal
            </a>
        </div>
    </form>
</div>
