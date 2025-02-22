<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlgoritmaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenyediaKontenController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TypeWisataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WisataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('home');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/ContentList/{kategori}', [UserController::class, 'showByCategory'])->name('wisata.kategori');
Route::get('/search', [UserController::class, 'searchWithKmeans'])->name('wisata.search');

Route::middleware(['guest', 'generate.public.id'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
});

Route::middleware('auth', )->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
});

Route::middleware(['auth', 'role:user', 'generate.public.id'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'updateUserProfile'])->name('user.profile.update');

    Route::get('/wisata/{id}/detail', [UserController::class, 'userWisataDetail'])->name('wisata.detail');
    Route::match(['get', 'post'], '/wisata/{id}/ulasan', [UserController::class, 'UlasanWisata'])->name('wisata.ulasan');
});

Route::middleware(['auth', 'role:penyedia_konten', 'generate.public.id'])->group(function () {
    Route::get('/dashboard-penyedia', [PenyediaKontenController::class, 'index'])->name('dashboard.penyedia');
    Route::get('/ulasan', [RatingController::class, 'index'])->name('penyedia.ulasan');
    Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
    Route::get('/penyedia/wisata/create', [WisataController::class, 'create'])->name('penyediaKonten.wisata.create');
    Route::post('/penyedia/wisata/store', [WisataController::class, 'store'])->name('penyediaKonten.wisata.store');
    Route::get('/wisata/{id}', [WisataController::class, 'show'])->name('penyediaKonten.wisata.show');
    Route::get('/wisata/{id}/edit', [WisataController::class, 'edit'])->name('wisata.edit');
    Route::put('/wisata/{id}', [WisataController::class, 'update'])->name('wisata.update');
    Route::delete('/wisata/{id}', [WisataController::class, 'destroy'])->name('wisata.destroy');
    Route::get('/penyedia/profile', [PenyediaKontenController::class, 'penyediaProfile'])->name('penyedia.profile');
    Route::match(['post', 'put'], '/penyedia/profile/update', [PenyediaKontenController::class, 'updatePenyediaProfile'])
    ->name('penyedia.profile.update');
});

Route::middleware(['auth', 'role:admin', 'generate.public.id'])->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/add-admin', [AuthController::class, 'showAddAdminForm'])->name('add-admin-form');
    Route::post('/add-admin', [AuthController::class, 'addAdmin'])->name('add-admin');
    Route::get('/admin/wisata', [AdminController::class, 'adminWisataList'])->name('admin.wisata.list');
    Route::get('/admin/ulasan', [AdminController::class, 'adminUlasanList'])->name('admin.ulasan.list');
    Route::get('/admin/pengguna', [AdminController::class, 'adminPenggunaList'])->name('admin.pengguna.list');
    Route::get('/admin/pengelola', [AdminController::class, 'adminPengelolaIndex'])->name('admin.pengelola.list');
    Route::get('/admin/data/visitor', [AdminController::class, 'visitor'])->name('admin.visitor');
    Route::get('/admin/type-wisata/create', [TypeWisataController::class, 'create'])->name('admin.type-wisata.create');
    Route::post('/admin/type-wisata/store', [TypeWisataController::class, 'store'])->name('admin.type-wisata.store');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::put('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
});


Route::post('/save-location', function (Request $request) {
    $ip = $request->ip();
    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');
    $lokasi = $request->input('lokasi');
    $userAgent = $request->header('User-Agent');
    $cookie = $request->cookie('user_tracking') ?? 'no_cookie';
    $userId = auth()->id();

    $query = DB::table('location')
        ->when($userId, function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        }, function ($query) use ($ip, $cookie) {
            return $query->where('ip_address', $ip)->where('cookie', $cookie);
        });

    $existingLocation = $query->first();

    if ($existingLocation) {
        DB::table('location')
            ->where('id', $existingLocation->id)
            ->update([
                'latitude' => $latitude,
                'longitude' => $longitude,
                'lokasi' => $lokasi,
                'updated_at' => now(),
            ]);
    } else {
        DB::table('location')->insert([
            'user_id' => $userId,
            'ip_address' => $ip,
            'os' => getOS($userAgent),
            'browser' => getBrowser($userAgent),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'cookie' => $cookie,
            'lokasi' => $lokasi,
            'created_at' => now(),
        ]);
    }

    return response()->json(['message' => 'Lokasi berhasil disimpan']);
});

