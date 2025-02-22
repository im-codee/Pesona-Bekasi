<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $table = 'wisata';
    protected $fillable = ['foto_wisata','foto_wisata2','foto_wisata3','foto_wisata4','nama_wisata', 'desa', 'kecamatan', 'alamat', 'kategori_wisata', 'latitude', 'longitude', 'no_telp', 'deskripsi', 'user_id'];

    public function typeWisata()
    {
        return $this->belongsToMany(TypeWisata::class, 'wisata_type_wisata', 'wisata_id', 'type_wisata_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'wisata_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
