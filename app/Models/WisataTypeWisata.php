<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataTypeWisata extends Model
{
    use HasFactory;
    protected $table = 'wisata_type_wisata';
    public $incrementing = false;
    protected $primaryKey = ['wisata_id', 'type_wisata_id'];
    protected $fillable = ['wisata_id', 'type_wisata_id'];
}
