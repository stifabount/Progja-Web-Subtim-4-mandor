<?php
use App\Http\Controllers\BaseColorConfigController;
use App\Http\Controllers\BaseTextConfigurationController;
use App\Http\Controllers\BaseImageConfigurationController;

Route::prefix('base-color')->group(function () {
    Route::get('/', [BaseColorConfigController::class, 'index'])->name('admin.base-color');
    Route::post('/store', [BaseColorConfigController::class, 'store'])->name('admin.base-color.store');
});
Route::prefix('base-text')->group(function () {
    Route::post('/store', [BaseTextConfigurationController::class, 'store'])->name('admin.base-text.store');
});
Route::prefix('base-image')->group(function () {
    Route::post('/store', [BaseImageConfigurationController::class, 'store'])->name('admin.base-image.store');
});


?>