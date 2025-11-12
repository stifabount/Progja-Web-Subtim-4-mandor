<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\BaseImageConfiguration;
use Illuminate\Support\Facades\Cache;

class BaseImageConfigurationController
{
    function clearCache(){
        Cache::forget('site_config');
    }
    public function store(Request $request)
    {
        $request->validate([
            'logo_desa' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024', 
        ]);

        if ($request->hasFile('logo_desa')) {
            $file = $request->file('logo_desa');
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $path = 'uploads/' . $filename;
            
            if (!BaseImageConfiguration::first()) {
                $image = new BaseImageConfiguration();
                $image->logo_path = $path;
                $image->save();
            } else {
                $config = BaseImageConfiguration::first();
                $config->update(['logo_path' => $path]);
            }
            $this->clearCache();
            return response()->json(['success' => 'Logo desa berhasil diunggah.'], 200);
        }

        return response()->json(['error' => 'Gagal mengunggah logo desa.'], 500);
    }
}
