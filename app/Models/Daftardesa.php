<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftardesa extends Model
{
    /** @use HasFactory<\Database\Factories\DaftardesaFactory> */
    use HasFactory;
    protected $fillable = [
        'nama_desa','gambar_desa',
    ];
}
