<?php

namespace App\Livewire;

use Livewire\Component;

class AccountSettings extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $currentPassword = '';
    public $newPassword = '';
    public $newPasswordConfirm = '';

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|max:15',
            'currentPassword' => 'nullable|string',
            'newPassword' => $this->newPassword ? 'required|string|min:6|confirmed' : 'nullable',
            'newPasswordConfirm' => $this->newPassword ? 'required|string|min:6' : 'nullable',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon wajib diisi',
            'newPassword.min' => 'Password baru minimal 6 karakter',
            'newPassword.confirmed' => 'Konfirmasi password tidak sesuai',
        ];
    }

    public function updateProfile()
    {
        $validated = $this->validate();

        $user = auth()->user();

        // Update basic info
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Update password if provided
        if ($this->newPassword) {
            if (!password_verify($validated['currentPassword'], $user->password)) {
                $this->addError('currentPassword', 'Password saat ini tidak sesuai');
                return;
            }
            $user->update(['password' => bcrypt($validated['newPassword'])]);
        }

        // Clear password fields
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPasswordConfirm = '';

        $this->dispatch('swal:success', message: 'Profil berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.account-settings');
    }
}
