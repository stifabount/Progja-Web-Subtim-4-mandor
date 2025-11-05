<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseColorConfig extends Model
{
    protected $table = 'base_color_configuration';

    protected $fillable = [
        'base_color',
        'primary_color',
        'secondary_color',
        'third_color',
    ];
    public $appends = [
        'base_color_hex',
        'primary_color_hex',
        'secondary_color_hex',
        'third_color_hex',
    ];

    function rgbToHex($rgbString)
    {
        // Split "255,0,0" into [255, 0, 0]
        $rgbArray = explode(',', $rgbString);

        // Convert each to integer
        $r = intval($rgbArray[0]);
        $g = intval($rgbArray[1]);
        $b = intval($rgbArray[2]);

        // Format into hex
        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    public function getBaseColorHexAttribute()
    {
        return $this->base_color ? $this->rgbToHex($this->base_color) : null;
    }
    public function getPrimaryColorHexAttribute()
    {
       return $this->pr_color ? $this->rgbToHex($this->pr_color) : null;
    }
    public function getSecondaryColorHexAttribute()
    {
        return $this->sec_color ? $this->rgbToHex($this->sec_color) : null;
    }
    public function getThirdColorHexAttribute()
    {
        return $this->third_color ? $this->rgbToHex($this->third_color) : null;
    }
}
