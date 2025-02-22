<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Wisata;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        $wisataIds = Wisata::where('user_id', Auth::id())->pluck('id');

        $ratings = Rating::whereIn('wisata_id', $wisataIds)
            ->latest()
            ->get();

        return view('penyediaKonten.ulasan', compact('ratings'));
    }
}
