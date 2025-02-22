<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Wisata;
use App\Models\Rating;
use App\Models\Location;


class PenyediaKontenController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $jumlahWisata = Wisata::where('user_id', $user->id)->count();

        $jumlahUlasan = Rating::whereIn('wisata_id', Wisata::where('user_id', $user->id)->pluck('id'))->count();

        $totalRating = Rating::whereIn('wisata_id', Wisata::where('user_id', $user->id)->pluck('id'))->sum('rating');

        $averageRating = $jumlahUlasan > 0 ? $totalRating / $jumlahUlasan : 0;

        $ulasanTerbaru = Rating::whereIn('wisata_id', Wisata::where('user_id', $user->id)->pluck('id'))
            ->latest()
            ->take(5)
            ->get();

        return view('penyediaKonten.dashboard', compact('jumlahWisata', 'jumlahUlasan', 'totalRating', 'averageRating', 'ulasanTerbaru'));
    }

    public function penyediaProfile()
    {
        $penyedia = Auth::user();

        $lokasi = Location::where('user_id', $penyedia->id)->first();

        return view('penyediaKonten.profile', compact('penyedia', 'lokasi'));
    }

    public function updatePenyediaProfile(Request $request)
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


