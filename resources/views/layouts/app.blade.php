<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kost Mart - E-Commerce untuk Anak Kost')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                    Kost Mart
                </a>

                <!-- Search Bar (Desktop) -->
                <div class="hidden md:flex flex-1 mx-8">
                    <input 
                        type="text" 
                        placeholder="Cari produk..."
                        class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button class="bg-blue-600 text-white px-4 rounded-r-lg hover:bg-blue-700 transition">
                        🔍
                    </button>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center gap-4">
                    <!-- Cart Icon (for customers) -->
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <a href="{{ route('cart.index') }}" class="relative hover:text-blue-600 transition" title="Keranjang">
                                <span class="text-2xl">🛒</span>
                                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                                    @livewire('cart-count')
                                </span>
                            </a>
                        @endif
                    @endauth

                    <!-- User Menu -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                <span class="text-xl">👤</span>
                                <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <span class="text-xs text-gray-500">▼</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition border border-gray-100">
                                <!-- User Info -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                    <p class="text-xs mt-1 inline-block px-2 py-1 rounded-full {{ auth()->user()->role === 'seller' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ auth()->user()->role === 'seller' ? '🏪 Penjual' : '👤 Pembeli' }}
                                    </p>
                                </div>

                                <!-- Menu Items -->
                                <a href="{{ route('orders.index') }}" class="block px-4 py-3 hover:bg-blue-50 text-gray-700 w-full text-left border-b border-gray-100">
                                    📦 Pesanan Saya
                                </a>

                                @if(auth()->user()->role === 'seller')
                                    <a href="{{ route('seller.products.index') }}" class="block px-4 py-3 hover:bg-purple-50 text-gray-700 w-full text-left border-b border-gray-100">
                                        🏪 Dashboard Penjual
                                    </a>
                                @endif

                                <a href="{{ route('settings.account') }}" class="block px-4 py-3 hover:bg-yellow-50 text-gray-700 w-full text-left border-b border-gray-100">
                                    ⚙️ Pengaturan Akun
                                </a>

                                <form method="POST" action="{{ route('logout') }}" class="block w-full">
                                    @csrf
                                    <button type="submit" class="px-4 py-3 hover:bg-red-50 w-full text-left text-red-600 font-medium rounded-b-lg transition">
                                        🚪 Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold px-3 py-2 rounded-lg hover:bg-blue-50 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="md:hidden mt-4">
                <input 
                    type="text" 
                    placeholder="Cari produk..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Kost Mart</h3>
                    <p class="text-gray-400">Platform e-commerce terpercaya untuk anak kost dengan berbagai pilihan produk berkualitas dan harga terjangkau.</p>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Kategori</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white">Makanan & Minuman</a></li>
                        <li><a href="#" class="hover:text-white">Elektronik</a></li>
                        <li><a href="#" class="hover:text-white">Perlengkapan Kamar</a></li>
                        <li><a href="#" class="hover:text-white">Kebutuhan Sehari-hari</a></li>
                    </ul>
                </div>

                <!-- Help -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Bantuan</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white">Cara Berbelanja</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Pengiriman</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Pengembalian</a></li>
                        <li><a href="#" class="hover:text-white">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Kontak</h3>
                    <p class="text-gray-400 mb-2">📞 (0212) 345-6789</p>
                    <p class="text-gray-400 mb-2">📧 support@kostmart.com</p>
                    <p class="text-gray-400">📍 Jakarta, Indonesia</p>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Kost Mart. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        Livewire.on('swal:success', event => {
            Swal.fire({
                title: 'Berhasil!',
                text: event.detail.message || 'Operasi berhasil dilakukan.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('swal:error', event => {
            Swal.fire({
                title: 'Terjadi Kesalahan!',
                text: event.detail.message || 'Terjadi kesalahan saat melakukan operasi.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
</body>
</html>
