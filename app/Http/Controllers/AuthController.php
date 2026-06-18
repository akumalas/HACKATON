<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function login()
    {
        return view('auth.login');
    }

    // 2. Proses Validasi Login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    // 3. Tampilkan Halaman Register
    public function register()
    {
        // Cek apakah sudah ada admin di database
        $adminSudahAda = User::where('role', 'admin')->exists();
        return view('auth.register', compact('adminSudahAda'));
    }

    // 4. Proses Simpan User Baru
    public function store(Request $request)
    {
        $adminSudahAda = User::where('role', 'admin')->exists();

        // Mencegah eksploitasi Inspect Element
        if ($request->role === 'admin' && $adminSudahAda) {
            return back()->with('error', 'Pendaftaran gagal: Admin sudah ada.');
        }

        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'username' => 'required|unique:users|max:50',
            'password' => 'required|min:5',
            'role' => 'required|in:admin,mahasiswa'
        ]);

        // Enkripsi password otomatis oleh Laravel
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 5. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}