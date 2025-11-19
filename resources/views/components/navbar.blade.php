<!-- Navbar Component -->
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
                    wire:model.live="search"
                    class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button class="bg-blue-600 text-white px-4 rounded-r-lg hover:bg-blue-700 transition">
                    🔍
                </button>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center gap-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative">
                    <span class="text-2xl">🛒</span>
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        @livewire('cart-count')
                    </span>
                </a>

                <!-- User Menu -->
                @auth
                    <div class="relative group">
                        <button class="text-2xl">👤 {{ auth()->user()->name }}</button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition">
                            <p class="px-4 py-2 text-sm text-gray-600 border-b">
                                {{ auth()->user()->role === 'seller' ? '🏪 Penjual' : '👤 Pembeli' }}
                            </p>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                                📦 Pesanan Saya
                            </a>
                            @if(auth()->user()->role === 'seller')
                                <a href="{{ route('seller.products.index') }}" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                                    🏪 Dashboard Penjual
                                </a>
                            @endif
                            <a href="{{ route('settings.account') }}" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                                ⚙️ Pengaturan
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="px-4 py-2 hover:bg-gray-100 w-full text-left rounded-b-lg text-red-600">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
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
