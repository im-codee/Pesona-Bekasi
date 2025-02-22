<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Wisata;
use App\Models\TypeWisata;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::where('user_id', auth()->id())
                        ->with('ratings')
                        ->get();

        return view('penyediaKonten.content.contentIndex', compact('wisata'));
    }

    public function create()
    {
        $typeWisata = TypeWisata::all();
        $userId = Auth::id();
        return view('penyediaKonten.content.contentCreate', compact('typeWisata', 'userId'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'nama_wisata' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kategori_wisata' => 'required|in:waterpark,mall,wisata_alam,wisata_kuliner,danau,pantai,tempat_bersejarah,sport,lainnya',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'no_telp' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string',
            'type_wisata' => 'nullable|array',
            'type_wisata.*' => 'exists:type_wisata,id',
            'foto_wisata' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
            'foto_wisata2' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
            'foto_wisata3' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
            'foto_wisata4' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
        ]);

        foreach (['foto_wisata', 'foto_wisata2', 'foto_wisata3', 'foto_wisata4'] as $foto) {
            if ($request->hasFile($foto)) {
                $validatedData[$foto] = $request->file($foto)->store('wisata_images', 'public');
            } else {
                unset($validatedData[$foto]);
            }
        }

        $wisata = Wisata::create($validatedData);

        if ($request->has('type_wisata')) {
            $wisata->typeWisata()->sync($request->type_wisata);
        }

        return redirect()->route('penyediaKonten.wisata.create')->with('success', 'Wisata berhasil ditambahkan!');
    }

    public function show($id)
    {
        $wisata = Wisata::with(['typeWisata', 'ratings'])->findOrFail($id);
        return view('penyediaKonten.content.contentShow', compact('wisata'));
    }

    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id);
        $typeWisata = TypeWisata::all();

        $selectedTypes = $wisata->typeWisata()->pluck('type_wisata_id')->toArray();

        return view('penyediaKonten.content.contentEdit', compact('wisata', 'typeWisata', 'selectedTypes'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kategori_wisata' => 'required|in:waterpark,mall,wisata_alam,wisata_kuliner,danau,pantai,tempat_bersejarah,sport,lainnya',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'no_telp' => 'nullable|string|max:15',
            'deskripsi' => 'nullable|string',
            'type_wisata' => 'nullable|array',
            'type_wisata.*' => 'exists:type_wisata,id',
            'foto_wisata' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
            'foto_wisata2' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
            'foto_wisata3' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
            'foto_wisata4' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,avif,gif|max:5120',
        ]);

        $wisata = Wisata::findOrFail($id);

        foreach (['foto_wisata', 'foto_wisata2', 'foto_wisata3', 'foto_wisata4'] as $foto) {
            if ($request->hasFile($foto)) {
                if ($wisata->$foto) {
                    Storage::delete('public/' . $wisata->$foto);
                }
                $validatedData[$foto] = $request->file($foto)->store('wisata_images', 'public');
            }
        }

        $wisata->update($validatedData);

        if ($request->has('type_wisata')) {
            $wisata->typeWisata()->sync($request->type_wisata);
        }

        return redirect()->route('wisata.index')->with('success', 'Wisata berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);

        if ($wisata->foto_wisata) {
            Storage::delete('public/' . $wisata->foto_wisata);
        }
        if ($wisata->foto_wisata2) {
            Storage::delete('public/' . $wisata->foto_wisata2);
        }
        if ($wisata->foto_wisata3) {
            Storage::delete('public/' . $wisata->foto_wisata3);
        }
        if ($wisata->foto_wisata4) {
            Storage::delete('public/' . $wisata->foto_wisata4);
        }

        $wisata->delete();

        return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil dihapus!');
    }

}

