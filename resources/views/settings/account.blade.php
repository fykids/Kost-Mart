@extends('layouts.app')

@section('title', 'Pengaturan Akun - Kost Mart')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pengaturan Akun</h1>
            <p class="text-gray-600 mt-2">Kelola profil dan keamanan akun Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Sidebar Menu -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-4 sticky top-20">
                    <nav class="space-y-2">
                        <a href="#profile" class="block px-4 py-2 rounded-lg bg-blue-50 text-blue-600 font-medium border-l-4 border-blue-600">
                            👤 Profil
                        </a>
                        <a href="#password" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                            🔐 Ubah Password
                        </a>
                        <a href="#security" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                            🛡️ Keamanan
                        </a>
                        @if(auth()->user()->role === 'seller')
                            <a href="#seller-info" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                                🏪 Info Penjual
                            </a>
                        @endif
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-3">
                @livewire('account-settings')
            </div>
        </div>
    </div>
</div>
@endsection
