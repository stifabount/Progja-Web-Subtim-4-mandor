@extends('layouts.adminlayout')
@section('child')
    <main class="content px-3 py-2">
        <div class="container-fluid" id="admin-profile-desa">
            <div class="mt-3 mb-3">
                <h4>Kelola Profile Desa</h4>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Profil Desa</h5>
                            <hr>
                            {{-- Foto --}}
                            <div class="form-group row mb-3">
                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Foto:</label>
                                <div class="col-lg-10 col-md-9 col-sm-8">
                                    <img src="{{ asset('storage/' . $profiledesa->gambar_profiledesa) }}"
                                        alt="Foto Profil Desa" class="img-thumbnail"
                                        style="max-width: 500px; height: auto;">
                                </div>
                            </div>

                            {{-- Sejarah --}}
                            <div class="form-group row mb-3">
                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Sejarah:</label>
                                <div class="col-lg-10 col-md-9 col-sm-8">
                                    {!! $profiledesa->sejarah_desa !!}
                                </div>
                            </div>

                            {{-- Visi --}}
                            <div class="form-group row mb-3">
                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Visi:</label>
                                <div class="col-lg-10 col-md-9 col-sm-8">
                                    {{ $profiledesa->visi_desa }}
                                </div>
                            </div>

                            {{-- Misi --}}
                            <div class="form-group row mb-3">
                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Misi:</label>
                                <div class="col-lg-10 col-md-9 col-sm-8">
                                    {!! $profiledesa->misi_desa !!}
                                </div>
                            </div>

                            {{-- Tombol Edit --}}
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-warning text-white" data-bs-toggle="modal"
                                    data-bs-target="#editProfilDesaModal" onclick="loadEditData({{ $profiledesa }})">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>

                        <!-- Nama Desa -->

                        <div class="modal fade" id="editProfilDesaModal" tableindex="-1"
                            aria-labelledby="editProfilDesaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title" id="editProfilDesaModalLabel">Edit Profil Desa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- here the form --}}

                                        <form method="POST" enctype="multipart/form-data" id="editLayaAdminForm">
                                            @method('put')
                                            @csrf
                                            <input type="text" name="id" required hidden value="{{ $profiledesa->id }}">
                                            <input type="hidden" name="oldImage" id="editGambar">
                                            <!-- Foto Desa -->
                                            <div class="form-group row mb-3">
                                                <img src="{{ asset('storage/' . $profiledesa->gambar_profiledesa) }}"
                                                    alt="no image yet" id="previewImage">
                                                <label for="fotoDesa" class="col-lg-2 col-md-3 col-sm-4 form-label">Foto
                                                    Desa:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="file" class="form-control" name="gambar_profiledesa"
                                                        accept="image/*" multiple onchange="changeImage(event)">
                                                </div>
                                            </div>
                                            <!-- Sejarah Desa -->
                                            <div class="form-group row mb-3">
                                                <label for="sejarahDesa"
                                                    class="col-lg-2 col-md-3 col-sm-4 form-label">Sejarah
                                                    Desa:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <textarea name="sejarah_desa" id="summernote-sejarah" required></textarea>
                                                </div>
                                            </div>
                                            <!-- Visi Desa -->
                                            <div class="form-group row mb-3">
                                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Visi Desa:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <textarea class="form-control" name="visi_desa" placeholder="Masukkan Visi Desa" required>{{ $profiledesa->visi_desa }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Misi Desa -->
                                            <!-- Link Video Profil Desa -->
                                            <div class="form-group row mb-3">
                                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Link Video Profil:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="text"
                                                        name="link_video_profile"
                                                        class="form-control"
                                                        placeholder="https://www.youtube.com/watch?v=..."
                                                        value="{{ $profiledesa->link_video_profile ?? '' }}">
                                                </div>
                                            </div>

                                            
                                            <!-- Link Video Profil Desa -->
                                            <div class="form-group row mb-3">
                                                <label for="misiDesa" class="col-lg-2 col-md-3 col-sm-4 form-label">Misi
                                                    Desa:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <textarea name="misi_desa" id="summernote-misidesa" required></textarea>
                                                </div>
                                            </div>

                                            <!-- Additional Details (Total Jiwa, Total KK, Total Laki-laki, Total Perempuan) -->
                                            <div class="form-group row gx-3 gy-3">
                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Total Jiwa:</label>
                                                    <input type="number" class="form-control" name="total_jiwa" required
                                                        value="{{ $profiledesa->total_jiwa }}">
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Total Kepala Keluarga:</label>
                                                    <input type="number" class="form-control" name="total_kk" required
                                                        value="{{ $profiledesa->total_kk }}">
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Total Laki-Laki:</label>
                                                    <input type="number" class="form-control" name="total_laki_laki"
                                                        required value="{{ $profiledesa->total_laki_laki }}">
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <label class="form-label">Total Perempuan:</label>
                                                    <input type="number" class="form-control" name="total_perempuan" required
                                                        value="{{ $profiledesa->total_perempuan }}">
                                                </div>
                                            </div>

                                            <!-- Suku -->
                                            <div class="form-group row mt-3 mb-3">
                                                <label class="col-lg-2 col-md-3 col-sm-4 form-label"> Suku:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <div class="row gx-3 gy-2">
                                                        <div class="col-lg-2 col-md-3">
                                                            <label class="form-label">Melayu</label>
                                                            <input type="number" class="form-control"
                                                                name="total_melayu"
                                                                value="{{ $profiledesa->total_melayu }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label class="form-label">Madura</label>
                                                            <input type="number" class="form-control"
                                                                name="total_madura"
                                                                value="{{ $profiledesa->total_madura }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label class="form-label">Tionghoa</label>
                                                            <input type="number" class="form-control"
                                                                name="total_tionghoa"
                                                                value="{{ $profiledesa->total_tionghoa }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label class="form-label">Dayak</label>
                                                            <input type="number" class="form-control" name="total_dayak"
                                                                value="{{ $profiledesa->total_dayak }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label class="form-label">Jawa</label>
                                                            <input type="number" class="form-control" name="total_jawa"
                                                                value="{{ $profiledesa->total_jawa }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label class="form-label">Bugis</label>
                                                            <input type="number" class="form-control" name="total_bugis"
                                                                value="{{ $profiledesa->total_bugis }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label class="form-label">Lainnya</label>
                                                            <input type="number" class="form-control"
                                                                name="total_suku_lainnya"
                                                                value="{{ $profiledesa->total_suku_lainnya }}"
                                                                placeholder="" min="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Agama -->
                                            <div class="form-group row mt-3 mb-3">
                                                <label class="col-lg-2 col-md-3 col-sm-4 form-label"> Agama:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <div class="row gx-3 gy-2">
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="agamaIslam" class="form-label">Islam</label>
                                                            <input type="number" class="form-control" name="total_islam"
                                                                value="{{ $profiledesa->total_islam }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="agamaKatolik" class="form-label">Katolik</label>
                                                            <input type="number" class="form-control"
                                                                name="total_katolik"
                                                                value="{{ $profiledesa->total_katolik }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="agamaProtestan"
                                                                class="form-label">Protestan</label>
                                                            <input type="number" class="form-control"
                                                                name="total_protestan"
                                                                value="{{ $profiledesa->total_protestan }}"
                                                                placeholder="" min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="agamaBuddha" class="form-label">Buddha</label>
                                                            <input type="number" class="form-control"
                                                                name="total_buddha" id="agamaBuddha"
                                                                value="{{ $profiledesa->total_buddha }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="agamaHindu" class="form-label">Hindu</label>
                                                            <input type="number" class="form-control" name="total_hindu"
                                                                value="{{ $profiledesa->total_hindu }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="agamaKonghuchu"
                                                                class="form-label">Konghuchu</label>
                                                            <input type="number" class="form-control"
                                                                name="total_konghuchu"
                                                                value="{{ $profiledesa->total_konghuchu }}"
                                                                placeholder="" min="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pendidikan -->
                                            <div class="form-group row mt-3 mb-3">
                                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Pendidikan:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <div class="row gx-3 gy-2">
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="belum_sekolah" class="form-label">Belum Sekolah</label>
                                                            <input type="number" class="form-control" name="total_belum_sekolah"
                                                                value="{{ $profiledesa->total_belum_sekolah }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="tamat_SD" class="form-label">Tamat SD</label>
                                                            <input type="number" class="form-control"
                                                                name="total_tamat_SD"
                                                                value="{{ $profiledesa->total_tamat_SD }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="tamat_SMP" class="form-label">Tamat SMP</label>
                                                            <input type="number" class="form-control"
                                                                name="total_tamat_SMP"
                                                                value="{{ $profiledesa->total_tamat_SMP }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="tamat_SMA" class="form-label">Tamat SMA</label>
                                                            <input type="number" class="form-control"
                                                                name="total_tamat_SMA"
                                                                value="{{ $profiledesa->total_tamat_SMA }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="diploma1" class="form-label">Diploma 1</label>
                                                            <input type="number" class="form-control"
                                                                name="total_diploma1"
                                                                value="{{ $profiledesa->total_diploma1 }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="diploma2" class="form-label">Diploma 2</label>
                                                            <input type="number" class="form-control"
                                                                name="total_diploma2"
                                                                value="{{ $profiledesa->total_diploma2 }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="diploma3" class="form-label">Diploma 3</label>
                                                            <input type="number" class="form-control"
                                                                name="total_diploma3"
                                                                value="{{ $profiledesa->total_diploma3 }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="sarjana1" class="form-label">Sarjana 1</label>
                                                            <input type="number" class="form-control"
                                                                name="total_sarjana1"
                                                                value="{{ $profiledesa->total_sarjana1 }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="sarjana2" class="form-label">Sarjana 2</label>
                                                            <input type="number" class="form-control"
                                                                name="total_sarjana2"
                                                                value="{{ $profiledesa->total_sarjana2 }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="sarjana3" class="form-label">Sarjana 3</label>
                                                            <input type="number" class="form-control"
                                                                name="total_sarjana3"
                                                                value="{{ $profiledesa->total_sarjana3 }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mata Pencaharian -->
                                            <div class="form-group row mt-3 mb-3">
                                                <label class="col-lg-2 col-md-3 col-sm-4 form-label"> Mata Pencaharian:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <div class="row gx-3 gy-2">
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="petani_pekebun" class="form-label">Petani/Pekebun</label>
                                                            <input type="number" class="form-control" name="total_petani_pekebun"
                                                                value="{{ $profiledesa->total_petani_pekebun }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="buruhTani" class="form-label">Buruh Tani</label>
                                                            <input type="number" class="form-control"
                                                                name="total_buruhTani"
                                                                value="{{ $profiledesa->total_buruhTani }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="swasta" class="form-label">Swasta</label>
                                                            <input type="number" class="form-control"
                                                                name="total_swasta"
                                                                value="{{ $profiledesa->total_swasta }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="pns" class="form-label">PNS</label>
                                                            <input type="number" class="form-control"
                                                                name="total_pns"
                                                                value="{{ $profiledesa->total_pns }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="pedagang" class="form-label">Pedagang</label>
                                                            <input type="number" class="form-control"
                                                                name="total_pedagang"
                                                                value="{{ $profiledesa->total_pedagang }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="pengrajin" class="form-label">Pengrajin</label>
                                                            <input type="number" class="form-control"
                                                                name="total_pengrajin"
                                                                value="{{ $profiledesa->total_pengrajin }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="peternak" class="form-label">Peternak</label>
                                                            <input type="number" class="form-control"
                                                                name="total_peternak"
                                                                value="{{ $profiledesa->total_peternak }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="nelayan" class="form-label">Nelayan</label>
                                                            <input type="number" class="form-control"
                                                                name="total_nelayan"
                                                                value="{{ $profiledesa->total_nelayan }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="lainlain" class="form-label">Lain-lain</label>
                                                            <input type="number" class="form-control"
                                                                name="total_lainlain"
                                                                value="{{ $profiledesa->total_lainlain }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Batas Desa -->
                                            <div class="form-group row mt-3 mb-3">
                                                <label for="batasUtaraDesa" class="col-lg-2 col-md-3 col-sm-4 form-label">Batas Utara:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="text" class="form-control" id="batasUtaraDesa"
                                                        name="batas_utara"
                                                        required value="{{ $profiledesa->batas_utara }}">
                                                </div>
                                            </div>
                                            <div class="form-group row mt-3 mb-3">
                                                <label for="batasTimurDesa" class="col-lg-2 col-md-3 col-sm-4 form-label">Batas Timur:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="text" class="form-control" id="batasTimurDesa"
                                                        name="batas_timur"
                                                        required value="{{ $profiledesa->batas_timur }}">
                                                </div>
                                            </div>
                                            <div class="form-group row mt-3 mb-3">
                                                <label for="batasSelatanDesa" class="col-lg-2 col-md-3 col-sm-4 form-label">Batas Selatan:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="text" class="form-control" id="batasSelatanDesa"
                                                        name="batas_selatan"
                                                        required value="{{ $profiledesa->batas_selatan }}">
                                                </div>
                                            </div>
                                            <div class="form-group row mt-3 mb-3">
                                                <label for="batasBaratDesa" class="col-lg-2 col-md-3 col-sm-4 form-label">Batas Barat:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="text" class="form-control" id="batasBaratDesa"
                                                        name="batas_barat"
                                                        required value="{{ $profiledesa->batas_barat }}">
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3 mb-3">
                                                <label class="col-lg-2 col-md-3 col-sm-4 form-label">Statistika Desa:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <div class="row gx-3 gy-2">
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="luas_desa" class="form-label">Luas Desa</label>
                                                            <input type="number" class="form-control" name="luas_desa"
                                                                value="{{ $profiledesa->luas_desa }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="jumlah_dusun" class="form-label">Jumlah Dusun</label>
                                                            <input type="number" class="form-control"
                                                                name="jumlah_dusun"
                                                                value="{{ $profiledesa->jumlah_dusun }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="jumlah_rt" class="form-label">Jumlah RT</label>
                                                            <input type="number" class="form-control"
                                                                name="jumlah_rt"
                                                                value="{{ $profiledesa->jumlah_rt }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                        <div class="col-lg-2 col-md-3">
                                                            <label for="jumlah_rw" class="form-label">Jumlah RW</label>
                                                            <input type="number" class="form-control"
                                                                name="jumlah_rw"
                                                                value="{{ $profiledesa->jumlah_rw }}" placeholder=""
                                                                min="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Peta Desa -->
                                            <div class="form-group row mt-3 mb-3">
                                                <label for="petaDesa" class="col-lg-2 col-md-3 col-sm-4 form-label">Peta
                                                    Desa:</label>
                                                <div class="col-lg-10 col-md-9 col-sm-8">
                                                    <input type="text" class="form-control" id="petaDesa"
                                                        placeholder="Masukkan tautan alamat peta Desa" name="peta_desa"
                                                        required value="{{ $profiledesa->peta_desa }}">
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning text-white">Update</button>
                                            </div>
                                        </form>
                                        {{-- to here --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('kodejs')
    <script>
        function loadEditData(layananadministrasi) {
            // Isi nilai input dengan data dari parameter
            $('#summernote-sejarah').summernote('code', layananadministrasi.sejarah_desa);
            $('#summernote-misidesa').summernote('code', layananadministrasi.misi_desa);
            document.getElementById('editGambar').value = layananadministrasi.gambar_profiledesa;
            const editForm = document.getElementById('editLayaAdminForm');
            editForm.action = `/profildesa/${layananadministrasi.id}`;
        }

        function changeImage(event) {
            const previewImage = document.getElementById('previewImage');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log(e.target.result);

                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
