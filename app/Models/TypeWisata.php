<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeWisata extends Model
{
    use HasFactory;
    protected $table = 'type_wisata';
    protected $fillable = ['nama_type'];
}
