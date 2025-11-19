<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar</h2>

    <form wire:submit.prevent="register">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" wire:model.defer="name" class="w-full mt-1 px-3 py-2 border rounded" />
            @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model.defer="email" class="w-full mt-1 px-3 py-2 border rounded" />
            @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">No. HP (opsional)</label>
            <input type="text" wire:model.defer="phone" class="w-full mt-1 px-3 py-2 border rounded" />
            @error('phone') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" wire:model.defer="password" class="w-full mt-1 px-3 py-2 border rounded" />
            @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" wire:model.defer="password_confirmation" class="w-full mt-1 px-3 py-2 border rounded" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Peran</label>
            <select wire:model="role" class="w-full mt-1 px-3 py-2 border rounded">
                <option value="customer">Customer</option>
                <option value="seller">Seller</option>
            </select>
            @error('role') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Daftar</button>
            <a href="{{ route('login') }}" class="text-sm text-gray-600">Sudah punya akun? Login</a>
        </div>
    </form>
</div>
