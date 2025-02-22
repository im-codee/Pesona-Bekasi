<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeWisata;

class TypeWisataController extends Controller
{
    public function create()
    {
        return view('admin.AddTypeWisata');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_type' => 'required|string|max:255|unique:type_wisata',
        ]);

        TypeWisata::create([
            'nama_type' => $request->nama_type,
        ]);

        return redirect()->route('admin.type-wisata.create')
                        ->with('success', 'Tipe wisata berhasil ditambahkan!');
    }
}
