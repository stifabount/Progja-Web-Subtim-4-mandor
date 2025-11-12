<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfildesaController;
use App\Http\Controllers\PerangkatdesaController;
use App\Http\Controllers\LembagadesaController;
use App\Http\Controllers\LayananpublikController;
use App\Http\Controllers\LayananadministrasiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KelolakegiatanController;
use App\Http\Controllers\KelolakontakController;
use App\Http\Controllers\StrukturperangkatdesaController;
use App\Http\Controllers\DaftardesaController;
use App\Models\Pengumuman;
use App\Models\Profildesa;
use App\Models\Kelolakegiatan;
use App\Models\Strukturperangkatdesa;
use App\Models\Layananadministrasi;
use Illuminate\Support\Facades\Route;

Route::get('/', [PerangkatdesaController::class, 'show']);
Route::get('/lembaga-desa', [LembagadesaController::class, 'show']);
Route::get('/layanan-publik', [LayananpublikController::class, 'show']);

Route::get('/profile-desa', function () {
    $profil = Profildesa::first();
    return view('user/profile-desa',[
        'profiledesa' => Profildesa::first()
     ]);
});
Route::get('/perangkat-desa', function () {
    return view('user/perangkat-desa',[
        'strukturperangkatdesa' => Strukturperangkatdesa::first()
    ]);
});
Route::get('/daftar-kegiatan', function () {
    return view('user/kegiatan',[
        'kelolakegiatans' => Kelolakegiatan::all()
    ]);
});
Route::get('/daftar-kontak', function () {
    return view('user/kontak');
});
Route::get('/layanan-administrasi', function () {
    return view('user/layanan-administrasi',[
        'layananadministrasis' => Layananadministrasi::all()
    ]);
});
// Route::get('/layanan-publik', function () {
//     return view('user/layanan-publik');
// });
Route::get('/fasilitas-pendidikan', function () {
    return view('user/fasilitas-pendidikan');
});
// Route::get('/lembaga-desa', function () {
//     return view('user/lembaga-desa');
// });
Route::get('/pemerintahan-desa', function () {
    return view('user/pemerintahan-desa');
});
Route::get('/daftar-pengumuman', function () {
    return view('user/pengumuman',[
        'pengumuman' => Pengumuman::all()
    ]);
});
Route::get('/detail-pengumuman/{id}', function ($id) {
    return view('user/detail-pengumuman', [
        'pengumuman' => Pengumuman::find($id)
    ]);
});
Route::get('/struktur-pemerintahan', function () {
    return view('user/struktur-pemerintahan');
});
Route::get('/daftar-desa', function () {
    return view('user/daftar-desa',[
        'daftardesas' => Daftardesa::all()
    ]);
});
Route::get('/adminlogin', [LoginController::class, 'index'])->middleware('guest');
Route::post('/adminlogin', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
// Route::get('/admin', function(){
//     return view('admin/admin-dashboard');
// })->middleware('auth');
Route::get('/admin', function () {
    return view('admin/admin-dashboard',[
        'profiledesa' => Profildesa::first()
     ]);
})->middleware('auth');
Route::resource('/profildesa', ProfildesaController::class)->middleware('auth');
Route::resource('/perangkatdesa', PerangkatdesaController::class)->middleware('auth');
Route::resource('/lembagadesa', LembagadesaController::class)->middleware('auth');
Route::resource('/layananpublik', LayananpublikController::class)->middleware('auth');
Route::resource('/layananadministrasi', LayananadministrasiController::class)->middleware('auth');
Route::resource('/pengumuman', PengumumanController::class)->middleware('auth');
Route::resource('/kegiatan', KelolakegiatanController::class)->middleware('auth');
Route::resource('/kontak', KelolakontakController::class)->middleware('auth');
Route::resource('/strukturperangkatdesa', StrukturperangkatdesaController::class)->middleware('auth');
Route::resource('/daftardesa', DaftardesaController::class)->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    @include 'admin.php';
});

Route::get('/config', [App\Http\Controllers\ConfigController::class, 'config']);