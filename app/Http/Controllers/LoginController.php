<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\BaseColorConfig;
use App\Models\BaseTextConfiguration;
class LoginController  
{
    public function index()
    {
        return view('admin.admin-login', []);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $colors = BaseColorConfig::first();
            $texts = BaseTextConfiguration::first();
            if($colors){
                Session::put('base_color', $colors ? 'rgb(' . $colors->base_color . ')' : 'rgb(40, 106, 89)');
                Session::put('primary_color', $colors ? 'rgb(' . $colors->pr_color . ')' : 'rgb(255, 215, 0)');
                Session::put('secondary_color', $colors ? 'rgb(' . $colors->sec_color . ')' : 'rgb(248, 249, 250)');
                Session::put('third_color', $colors ? 'rgb(' . $colors->third_color . ')' : 'rgb(108, 117, 125)');
            }
            if($texts){
                Session::put('nama_desa', $texts ? $texts->nama_desa : 'Desa Sukamaju');
                Session::put('nama_kecamatan', $texts ? $texts->nama_kecamatan : 'Kecamatan Sukamakmur');
            }
            return redirect()->intended('/admin')
                ->with('success', 'Login berhasil! Selamat datang.');
        }
        

        return back()->with('error', 'Login gagal! Periksa kembali username dan password Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/adminlogin')->with('info', 'Anda telah logout.');
    }

    public function register(Request $request)
    {
        // Tambahkan logika pendaftaran pengguna jika diperlukan.
    }
}
