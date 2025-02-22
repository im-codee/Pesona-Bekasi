<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Wisata;
use App\Models\Rating;
use App\Models\Location;
use App\Models\TypeWisata;

class UserController extends Controller
{
    public function searchWithKmeans(Request $request)
    {
        // Ambil lokasi pengguna
        $userLocation = DB::table('location')
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$userLocation) {
            return redirect()->back()->with('error', 'Lokasi tidak ditemukan.');
        }

        $userLat = $userLocation->latitude;
        $userLng = $userLocation->longitude;

        // Ambil filter dari request
        $kategori = $request->input('kategori');
        $filter = $request->input('filter');
        $tipeWisata = $request->input('tipe_wisata');

        // Query awal
        $wisataQuery = Wisata::select('wisata.*')
            ->selectRaw("
                ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) )
                * cos( radians( longitude ) - radians(?) ) + sin( radians(?) )
                * sin( radians( latitude ) ) ) ) AS distance", [$userLat, $userLng, $userLat])
            ->with('ratings', 'typeWisata');

        // Filter berdasarkan kategori wisata
        if (!empty($kategori)) {
            $wisataQuery->where('kategori_wisata', $kategori);
        }

        // Filter berdasarkan tipe wisata
        if (!empty($tipeWisata)) {
            $wisataQuery->whereHas('typeWisata', function ($query) use ($tipeWisata) {
                $query->where('nama', $tipeWisata);
            });
        }

        // Jika menggunakan filter jarak/populer
        if ($filter === 'jarak') {
            $wisataQuery->orderBy('distance', 'asc');
        } elseif ($filter === 'populer') {
            $wisataQuery->withCount('ratings')->orderByDesc('ratings_count');
        }

        // Ambil data wisata
        $wisataList = $wisataQuery->get();

        // Jika filter adalah "jarak", gunakan K-Means
        if ($filter === 'jarak') {
            $clusters = $this->applyKMeans($wisataList, 3);
            return view('user.contentSearch', compact('clusters', 'wisataList'));
        }

        // Jika hanya kategori atau filter populer, gunakan view biasa
        return view('user.contentList', compact('wisataList'));
    }

    /**
     * Fungsi K-Means Clustering
     */
    private function applyKMeans($wisataList, $numClusters)
    {
        $dataPoints = [];

        // Siapkan array data point (hanya menyertakan jarak)
        foreach ($wisataList as $wisata) {
            $dataPoints[] = ['id' => $wisata->id, 'distance' => $wisata->distance];
        }

        // Jika data kurang dari jumlah cluster, langsung return data tanpa clustering
        if (count($dataPoints) < $numClusters) {
            return ['Cluster 1' => $wisataList];
        }

        // Inisialisasi centroid awal (gunakan jarak wisata pertama sebagai acuan)
        $centroids = array_slice($dataPoints, 0, $numClusters);
        $clusters = [];

        for ($i = 0; $i < 10; $i++) { // Iterasi maksimum 10 kali
            $clusters = [];

            // Pengelompokan berdasarkan centroid terdekat
            foreach ($dataPoints as $point) {
                $closestCluster = null;
                $minDistance = PHP_INT_MAX;

                foreach ($centroids as $index => $centroid) {
                    $distance = abs($point['distance'] - $centroid['distance']);
                    if ($distance < $minDistance) {
                        $minDistance = $distance;
                        $closestCluster = $index;
                    }
                }

                $clusters[$closestCluster][] = $point;
            }

            // Hitung ulang centroid berdasarkan rata-rata jarak dalam cluster
            foreach ($clusters as $index => $cluster) {
                $sum = array_sum(array_column($cluster, 'distance'));
                $count = count($cluster);
                $centroids[$index]['distance'] = $count ? $sum / $count : 0;
            }
        }

        // Kelompokkan hasil ke dalam array
        $finalClusters = [];
        foreach ($clusters as $index => $cluster) {
            $finalClusters["Cluster " . ($index + 1)] = collect($wisataList)
                ->whereIn('id', array_column($cluster, 'id'))
                ->all();
        }

        return $finalClusters;
    }

    public function index()
    {
        $wisata = Wisata::all();
        $tipeWisata = TypeWisata::all();

        return view('user.home', compact('wisata', 'tipeWisata'));
    }

    public function showByCategory($kategori)
    {
        if ($kategori === 'sports_other') {
            $wisataList = Wisata::whereIn('kategori_wisata', ['sport', 'lainnya'])->get();
        } else {
            $wisataList = Wisata::where('kategori_wisata', $kategori)->get();
        }

        return view('user.contentList', compact('wisataList', 'kategori'));
    }

    public function userWisataDetail($id)
    {
        $wisata = Wisata::with(['typeWisata', 'ratings'])->findOrFail($id);
        return view('user.contentDetail', compact('wisata'));
    }

    public function UlasanWisata(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'ulasan' => 'required|string|max:500',
            ]);

            Rating::create([
                'wisata_id' => $id,
                'users_id' => auth()->id(),
                'rating' => $request->rating,
                'ulasan' => $request->ulasan,
            ]);

            return redirect()->route('wisata.detail', $id)->with('success', 'Ulasan berhasil ditambahkan!');
        }

        $wisata = Wisata::with(['typeWisata', 'ratings'])->findOrFail($id);
        return view('user.contentDetail', compact('wisata'));
    }

    public function userProfile()
    {
        $user = Auth::user();

        $lokasi = Location::where('user_id', $user->id)->first();

        return view('user.profile', compact('user', 'lokasi'));
    }

    public function updateUserProfile(Request $request) {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'pekerjaan' => 'nullable|string|max:100',
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
