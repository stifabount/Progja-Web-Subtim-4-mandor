<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseTextConfiguration extends Model
{
    protected $table = 'base_text_configuration';

    protected $fillable = [
        'nama_desa',
        'nama_kecamatan',
    ];
}
