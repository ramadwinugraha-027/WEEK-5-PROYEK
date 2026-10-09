<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/barang');
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])
                     ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/barang');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required',
            'email'        => 'required|email|unique:users,email',
            'username'     => 'required|unique:users,username',
            'password'     => 'required|min:6',
            'no_hp'        => 'required',
            'alamat'       => 'required',
        ]);

        // Generate ID user otomatis
        $last = User::orderBy('id_user', 'desc')->first();
        $num = $last ? (int) substr($last->id_user, 1) + 1 : 1;
        $data['id_user'] = 'U' . str_pad($num, 3, '0', STR_PAD_LEFT);

        User::create($data);

        return redirect('/login')->with('sukses', 'Registrasi berhasil. Silakan login.');
    }
}
