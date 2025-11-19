<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kost Mart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <h1 class="text-3xl font-bold mb-2 text-center">Kost Mart</h1>
            <p class="text-gray-600 text-center mb-8">Login ke Akun Anda</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="your@email.com"
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                <!-- Submit -->
                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition"
                >
                    Login
                </button>
            </form>

            <!-- Register Link -->
            <p class="text-center text-gray-600 mt-6">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>
</body>
</html>
