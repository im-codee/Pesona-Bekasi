<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * SHOW LOGIN FORM - Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    /**
     * SHOW REGISTER FORM - Menampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    public function showAddAdminForm()
    {
        return view('Auth.addstaf');
    }

    /**
     * REGISTER - Mendaftarkan pengguna baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    /**
     * LOGIN - Autentikasi pengguna
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'user') {
                return redirect()->route('home')->with('success', 'Login berhasil!');
            } elseif ($user->role === 'penyedia_konten') {
                return redirect()->route('dashboard.penyedia')->with('success', 'Login berhasil!');
            } elseif ($user->role === 'admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Login berhasil!');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Akun tidak memiliki role yang valid.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    /**
     * LOGOUT - Keluar dari sesi pengguna
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    /**
     * ADD STAFF - Tambah akun staff (Hanya Admin)
     */
    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'sometimes|required|in:admin,penyedia_konten'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'penyedia_konten',
        ]);

        return redirect()->route('add-admin-form')->with('success', 'Admin atau penyedia konten berhasil ditambahkan!');
    }

    /**
     * CHANGE PASSWORD - Ubah password pengguna
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }
}
