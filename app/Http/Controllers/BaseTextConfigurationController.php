<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BaseTextConfiguration;
use Illuminate\Support\Facades\Cache;
class BaseTextConfigurationController
{
    public function store(Request $request)
    {
        function clearCache(){
            Cache::forget('site_config');
        }
        $validator = Validator::make($request->all(), [
            'nama_desa' => 'required|string',
            'nama_kecamatan' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            if (BaseTextConfiguration::count() > 0) {
                $textConfig = BaseTextConfiguration::first();
                $textConfig->nama_desa = $request->nama_desa;
                $textConfig->nama_kecamatan = $request->nama_kecamatan;
                $textConfig->save();    
            }
            else {
                $textConfig = new BaseTextConfiguration();
                $textConfig->nama_desa = $request->nama_desa;
                $textConfig->nama_kecamatan = $request->nama_kecamatan;
                $textConfig->save();
            }
            $this->clearCache();
            return response()->json(['success' => 'Base text configuration updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }
}
