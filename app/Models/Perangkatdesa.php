<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perangkatdesa extends Model
{
    /** @use HasFactory<\Database\Factories\PerangkatdesaFactory> */
    use HasFactory;
    protected $fillable = [
        'nama',
        'jabatan',
        'gambar_perangkatdesa',
    ];
}
