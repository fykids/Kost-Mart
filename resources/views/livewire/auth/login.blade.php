<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Login</h2>

    <form wire:submit.prevent="login">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model.defer="email" class="w-full mt-1 px-3 py-2 border rounded" />
            @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" wire:model.defer="password" class="w-full mt-1 px-3 py-2 border rounded" />
            @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="flex items-center justify-between mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="remember" class="form-checkbox" />
                <span class="ml-2 text-sm">Ingat saya</span>
            </label>

            <a href="{{ route('password.request') ?? '#' }}" class="text-sm text-blue-600">Lupa password?</a>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>
            <a href="{{ route('register') }}" class="text-sm text-gray-600">Belum punya akun? Daftar</a>
        </div>
    </form>
</div>
