@extends('layouts.adminlayout')

@section('kodeatas')
    <style>
       #baseLogo .dropify-wrapper p{
            color: var(--sec-color);
            font-family: var(--sec-font);
            line-height: 1.7;
            font-size: 16px;
        }
    </style>
@section('child')
    <main class="content px-3 py-2">
        <div class="container-fluid" id="admin-kegiatan">
            <div class="mt-3 mb-3">
                <h4>Kelola Data Dasar</h4>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        {{-- Warna Dasar --}}
                        <div class="col-12">
                            <div class="card" id="daftardesaCard">
                                <div class="card-body">
                                    <h5>Kelola Warna Dasar
                                        <hr>
                                    </h5>
                                    <!-- Form Input Kegiatan -->
                                    <form id="baseColor" method="POST" action="{{ route('daftardesa.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                               <div class="form-group">
                                                 <label for="baseColor" class="form-label">
                                                        Base Color:</label>
                                                        <input name="base_color" type="color" class="form-control"
                                                            id="baseColor" required value="{{$colors ? $colors['base_color_hex'] : ''}}">
                                                        <span class="text-small">Base color adalah warna dari elemen dasar (Warna Utama Web).</span>
                                                </div> 
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                               <div class="form-group">
                                                 <label for="primaryColor" class="form-label">
                                                        Primary Color:</label>
                                                        <input name="primary_color" type="color" class="form-control"
                                                            id="primaryColor" value="{{$colors ? $colors['primary_color_hex'] : ''}}" required>
                                                        <span class="text-small">Primary color adalah warna dari elemen utama.</span>
                                                </div> 
                                            </div>
                                             <div class="col-md-3 col-sm-6">
                                               <div class="form-group">
                                                 <label for="secondaryColor" class="form-label">
                                                        Secondary Color:</label>
                                                        <input name="secondary_color" type="color" class="form-control"
                                                            id="secondaryColor" value="{{$colors ? $colors['secondary_color_hex'] : ''}}" required>
                                                        <span class="text-small">Secondary color adalah warna dari elemen sekunder. (Warna Background Main Section)</span>
                                                </div> 
                                            </div>
                                             <div class="col-md-3 col-sm-6">
                                               <div class="form-group">
                                                 <label for="thirdColor" class="form-label">
                                                        Third Color:</label>
                                                        <input name="third_color" type="color" class="form-control"
                                                            id="thirdColor" value="{{$colors ? $colors['third_color_hex'] : ''}}" required>
                                                        <span class="text-small">Third color adalah warna dari elemen tambahan. (Warna Background Header Modal)</span>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-simpan">Simpan</button>
                                            <button type="button" onclick="resetForm()"
                                                class="btn btn-batal ms-2">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Nama Kecamatan --}}
                         <div class="col-12">
                            <div class="card" id="daftardesaCard">
                                <div class="card-body">
                                    <h5>Kelola Nama Desa dan Kecamatan
                                        <hr>
                                    </h5>
                                    <!-- Form Input Kegiatan -->
                                    <form id="baseText" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                 <label for="nama_desa" class="form-label">
                                                        Nama Desa:</label>
                                                        <input name="nama_desa" type="text" class="form-control" id="nama_desa" required value="{{$texts ? $texts->nama_desa : ""}}">
                                                </div> 
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                               <div class="form-group">
                                                 <label for="nama_kecamatan" class="form-label">
                                                        Nama Kecamatan:</label>
                                                        <input name="nama_kecamatan" type="text" class="form-control" id="nama_kecamatan" required value="{{$texts ? $texts->nama_kecamatan : ""}}">
                                                </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-simpan">Simpan</button>
                                            <button type="button" onclick="resetForm()"
                                                class="btn btn-batal ms-2">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Logo --}}
                        <div class="col-12">
                                <div class="card" id="daftardesaCard">
                                    <div class="card-body">
                                        <h5>Kelola Logo Desa
                                            <hr>
                                        </h5>
                                        <!-- Form Input Kegiatan -->
                                        <form id="baseLogo" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="logoDesa" class="form-label">Logo Desa:</label>
                                                        <input name="logo_desa" type="file" class="form-control dropify"
                                                            id="logoDesa" required accept=".jpg, .png, .jpeg, .webp" data-max-file-size="1M" data-allowed-file-extensions="png jpg jpeg webp">
                                                        <span class="text-small text-danger">
                                                            1. Ukuran Maksimal logo Adalah 1mb <br>
                                                            2. ekstensi file berupa jpg, png, jpeg, webp
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Preview Logo Desa Saat Ini:</label>
                                                        <div class="previewLogo">
                                                            @if($image && $image->logo_full_path)
                                                                <img src="{{ $image->logo_full_path }}" alt="Logo Desa" style="max-width: 250px; max-height: 250px;">
                                                            @else
                                                                <p>Tidak ada logo desa yang diunggah.</p>
                                                            @endif
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="submit" class="btn btn-simpan">Simpan</button>
                                                <button type="button" onclick="resetForm()" class="btn btn-batal ms-2">Batal</button>
                                            </div>
                                        </form>
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
        $(document).ready(function() {
            // Fungsi untuk mereset form
            function resetForm() {
                $('#baseColor')[0].reset();
            }
            $('.dropify').dropify();
            // Panggil fungsi resetForm saat tombol Batal diklik
            $('.btn-batal').click(function() {
                resetForm();
            });

            $('#baseColor').submit(function(event) {
                event.preventDefault(); // Mencegah form submit secara default

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.base-color.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                       if(response.success){
                            swal.fire({
                                type: 'success',
                                title: 'Sukses',
                                text: response.success,
                            }).then(() => {
                                location.reload(); // Muat ulang halaman setelah menutup notifikasi
                            });
                       } else {
                           swal.fire({
                                type: 'error',
                                title: 'Gagal',
                                text: response.error,
                            });
                       }
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan notifikasi error
                        alert('Terjadi kesalahan saat menyimpan warna dasar.');
                    }
                });
            });
            $('#baseText').submit(function(event) {
                event.preventDefault(); 

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.base-text.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                       if(response.success){
                            swal.fire({
                                type: 'success',
                                title: 'Sukses',
                                text: response.success,
                            }).then(() => {
                                location.reload(); 
                            });
                       } else {
                           swal.fire({
                                type: 'error',
                                title: 'Gagal',
                                text: response.error,
                            });
                       }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat menyimpan teks dasar.');
                    }
                });
            });
            $('#baseLogo').submit(function(event) {
                event.preventDefault(); 

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.base-image.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                       if(response.success){
                            swal.fire({
                                type: 'success',
                                title: 'Sukses',
                                text: response.success,
                            }).then(() => {
                                location.reload(); 
                            });
                       } else {
                           swal.fire({
                                type: 'error',
                                title: 'Gagal',
                                text: response.error,
                            });
                       }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat menyimpan logo desa.');
                    }
                });
            });
        });
    </script>
@endsection
