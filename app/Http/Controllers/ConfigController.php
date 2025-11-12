<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaseTextConfiguration;
use App\Models\BaseImageConfiguration;
use App\Models\BaseColorConfig;
use Illuminate\Support\Facades\Cache;
class ConfigController
{
    public function config(Request $request)
    {
        $config = Cache::remember('site_config', now()->addMinutes(30), function () {

            $colors = BaseColorConfig::first();
            $texts = BaseTextConfiguration::first();
            $images = BaseImageConfiguration::first();
            return [
                'version' => now()->timestamp,
                'colors' => [
                    'base_color' => $colors->base_color ?? '#ffffff',
                    'pr_color' => $colors->pr_color ?? '#000000',
                    'sec_color' => $colors->sec_color ?? '#cccccc',
                    'third_color' => $colors->third_color ?? '#f8f9fa',
                ],
                'images' => [
                    'logo_path' => $images->logo_path ?? '/default-logo.png',
                ],
                'texts' => [
                    'nama_desa' => $texts->nama_desa ?? 'Desa Default',
                    'nama_kecamatan' => $texts->nama_kecamatan ?? 'Kecamatan Default',
                ],
            ];
        });
        return response()->json($config);

    }
}
