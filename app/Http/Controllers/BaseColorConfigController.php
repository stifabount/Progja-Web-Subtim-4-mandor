<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaseColorConfig;
use App\Models\BaseTextConfiguration;
use App\Models\BaseImageConfiguration;
use Illuminate\Support\Facades\Validator;

class BaseColorConfigController
{
    function hextoRgb($hex) {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return $r.','.$g.','.$b;
    }
    function clearCache(){
        Cache::forget('site_config');
    }
    public function index()
    {
        $colors = BaseColorConfig::first();
        $texts = BaseTextConfiguration::first();
        $image = BaseImageConfiguration::first();
        return view('admin.admin-base-config', compact('colors', 'texts', 'image'));
    }
    public function store(Request $request)
    {
        $errors = Validator::make($request->all(), [
            'base_color' => 'required|string',
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'third_color' => 'required|string',
        ]);

        if ($errors->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }
        try{
            if(BaseColorConfig::count() > 0){
                $baseColor = BaseColorConfig::first();
                $baseColor->base_color = $this->hextoRgb($request->base_color);
                $baseColor->pr_color = $this->hextoRgb($request->primary_color);
                $baseColor->sec_color = $this->hextoRgb($request->secondary_color);
                $baseColor->third_color = $this->hextoRgb($request->third_color);
                $baseColor->save();
                return response()->json(['success' => 'Base color configuration updated successfully.']);
            }else{
                $baseColor = new BaseColorConfig();
                $baseColor->base_color = $this->hextoRgb($request->base_color);
                $baseColor->pr_color = $this->hextoRgb($request->primary_color);
                $baseColor->sec_color = $this->hextoRgb($request->secondary_color);
                $baseColor->third_color = $this->hextoRgb($request->third_color);
                $baseColor->save();
            }
            $this->clearCache();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save base color configuration.', 'exception' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Base color configuration saved successfully.']);
    }
}
