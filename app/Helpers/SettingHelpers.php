<?php
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

function getAppSettings() {
    return Cache::remember('app_settings', now()->addHours(1), function () {
        return Setting::pluck('value', 'key')->toArray();
    });
}