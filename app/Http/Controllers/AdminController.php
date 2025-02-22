<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Rating;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $browserData = Location::selectRaw('browser, COUNT(*) as total')
        ->groupBy('browser')
        ->pluck('total', 'browser');

        $totalWisata = Wisata::count();
        $totalUlasan = Rating::count();
        $totalPenyediaKonten = User::where('role', 'penyedia_konten')->count();
        $totalPengguna = User::where('role', 'user')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalVisitor = Location::count();

        $wisataPopuler = Wisata::with(['ratings', 'user'])
            ->withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalWisata',
            'totalUlasan',
            'totalPenyediaKonten',
            'totalPengguna',
            'totalAdmin',
            'totalVisitor',
            'wisataPopuler',
            'browserData'
        ));
    }

    public function adminWisataList()
    {
        $wisata = Wisata::all();

        return view('admin.data.contentIndex', compact('wisata'));
    }

    public function adminUlasanList()
    {
        $ulasans = Rating::with('wisata', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.data.ulasanIndex', compact('ulasans'));
    }

    public function adminPenggunaList()
    {
        $penggunas = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.data.penggunaIndex', compact('penggunas'));
    }

    public function adminPengelolaIndex()
    {
        $pengelolas = User::where('role', 'penyedia_konten')
            ->with('wisata')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.data.mitraIndex', compact('pengelolas'));
    }

    public function visitor()
    {
        $visitors = Location::all();

        return view('admin.data.visitor', compact('visitors'));
    }

    public function statistik(){

    }

    public function adminProfile()
    {
        $admin = Auth::user();

        $lokasi = Location::where('user_id', $admin->id)->first();

        return view('admin.profile', compact('admin', 'lokasi'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,avif|max:5120',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $path;
        }

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

}
