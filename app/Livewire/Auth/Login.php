<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $request = request();
            $request->session()->regenerate();

            $this->dispatch('swal:success', message: 'Login berhasil.');

            return redirect()->intended(route('home'));
        }

        $this->dispatch('swal:error', message: 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
