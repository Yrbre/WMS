<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return (object)[
                'success' => false,
                'message' => 'Email atau password salah'
            ];
        }

        request()->session()->regenerate();

        return (object)[
            'success' => true,
            'message' => 'Login berhasil',
            'user' => Auth::user()
        ];
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }
}
