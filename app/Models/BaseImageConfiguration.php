<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseImageConfiguration extends Model
{
    protected $table = 'base_image_configuration';

    protected $fillable = [
        'logo_path',
    ];
    public $appends = [
        'logo_full_path',
    ];
    
    public function getLogoFullPathAttribute()
    {
        return asset($this->logo_path);
    }
}
