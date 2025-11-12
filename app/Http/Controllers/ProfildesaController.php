<?php

namespace App\Http\Controllers;

use App\Models\Profildesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ProfildesaController  
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $profildesa = Profildesa::first();
        // dd($profildesa);
        return view('admin.admin-profile-desa', [
            'profiledesa' => Profildesa::first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profildesa $profildesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profildesa $profildesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profildesa $profildesa)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'sejarah_desa' => 'required',
                'visi_desa' => 'required',
                'misi_desa' => 'required',
                'link_video_profile' => 'required',

                'total_jiwa' => 'required',
                'total_kk' => 'required',
                'total_laki_laki' => 'required',
                'total_perempuan' => 'required',

                'total_melayu' => 'required',
                'total_madura' => 'required',
                'total_tionghoa' => 'required',
                'total_dayak' => 'required',
                'total_jawa' => 'required',
                'total_bugis' => 'required',
                'total_suku_lainnya' => 'required',

                'total_islam' => 'required',
                'total_katolik' => 'required',
                'total_protestan' => 'required',
                'total_buddha' => 'required',
                'total_hindu' => 'required',
                'total_konghuchu' => 'required',

                'total_belum_sekolah' => 'required',
                'total_tamat_SD' => 'required',
                'total_tamat_SMP' => 'required',
                'total_tamat_SMA' => 'required',
                'total_diploma1' => 'required',
                'total_diploma2' => 'required',
                'total_diploma3' => 'required',
                'total_sarjana1' => 'required',
                'total_sarjana2' => 'required',
                'total_sarjana3' => 'required',

                'total_petani_pekebun' => 'required',
                'total_buruhTani' => 'required',
                'total_swasta' => 'required',
                'total_pns' => 'required',
                'total_pedagang' => 'required',
                'total_pengrajin' => 'required',
                'total_peternak' => 'required',
                'total_nelayan' => 'required',
                'total_lainlain' => 'required',

                'batas_utara' => 'required',
                'batas_selatan' => 'required',
                'batas_barat' => 'required',
                'batas_timur' => 'required',

                'luas_desa' => 'required',
                'jumlah_dusun' => 'required',
                'jumlah_rt' => 'required',
                'jumlah_rw' => 'required',

                'peta_desa' => 'required',
                'gambar_profiledesa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ], [
                'required' => ':attribute wajib diisi.',
                'image' => ':attribute harus berupa gambar.',
                'mimes' => ':attribute harus berformat jpg, jpeg, atau png.',
                'max' => 'Ukuran file :attribute maksimal 2MB.'
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validatedData = $validator->validated();

            // Upload gambar jika ada
            if ($request->hasFile('gambar_profiledesa')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validatedData['gambar_profiledesa'] = $request->file('gambar_profiledesa')->store('gambar_yang_tersimpan');
            }

            // Update data profil desa
            $profildesa->update($validatedData);   
            if($profildesa){
            }
            return redirect('/profildesa')->with('success', 'Profil desa berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil desa: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profildesa $profildesa)
    {
        //
    }
}
