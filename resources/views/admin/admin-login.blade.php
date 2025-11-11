<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Desa Perapakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            padding: 30px;
        }
        .login-container img {
            display: block;
            margin: 0 auto 20px;
            width: 80px;
        }
        .login-container h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #ccc;
            border-radius: 0;
            height: 45px;
            font-size: 14px;
            padding-left: 10px;
            box-shadow: none;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #ccc; /* Tetap netral */
            outline: none; /* Hilangkan efek outline */
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            height: 45px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }

        .toast {
            border-radius: 15px !important;
        }
        .text-center{
            text-align: center !important;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img alt="Logo Kecamatan" class="logo" id="logo">
        <h2 class="nama_kecamatan">{{session('nama_kecamatan')}}</h2>
        <form action="/adminlogin" method="POST">
            @csrf
            <!-- Username Field -->
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <!-- Password Field -->
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="text-small text-center">
                Reset Password? <a href="https://wa.me/6285750139209">Tekan Disini</a>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @elseif (session('info'))
                toastr.info("{{ session('info') }}");
            @endif

            const cached = sessionStorage.getItem('site_config');
                if (cached) {
                    const data = JSON.parse(cached);
                    applyConfig(data);

                    // Optional refresh if admin updated
                    fetch('/config')
                        .then(res => res.json())
                        .then(latest => {
                            if (!data.version || latest.version !== data.version) {
                                sessionStorage.setItem('site_config', JSON.stringify(latest));
                                applyConfig(latest);
                            }
                        })
                        .catch(err => console.error('Config fetch error:', err));
                } else {
                    fetch('/config')
                        .then(res => res.json())
                        .then(data => {
                            sessionStorage.setItem('site_config', JSON.stringify(data));
                            applyConfig(data);
                        })
                        .catch(err => console.error('Config fetch error:', err));
                }

                async function applyConfig(config) {
                    const { colors, images, texts } = config;

                    // Apply colors
                    if (colors) {
                        document.documentElement.style.setProperty('--pr-color','rgb(' + colors.pr_color + ')');
                        document.documentElement.style.setProperty('--sec-color','rgb(' + colors.sec_color + ')');
                        document.documentElement.style.setProperty('--third-color','rgb(' + colors.third_color + ')');
                        document.documentElement.style.setProperty('--base-color','rgb(' + colors.base_color + ')');
                    }

                    // Apply images
                    const logoEl = document.getElementById('logo');
                    if (images && logoEl) logoEl.src = images.logo_path;

                    // Apply texts
                    document.querySelectorAll('.nama_desa').forEach(el => el.textContent = texts?.nama_desa ?? 'Desa Default');
                    document.querySelectorAll('.nama_kecamatan').forEach(el => el.textContent = texts?.nama_kecamatan ?? 'Kecamatan Default');

                    // Footer text if exists
                    const footerNama = document.getElementById('nama_desa');
                    if (footerNama && texts) footerNama.textContent = texts.nama_desa;
                }

            async function loadConfig() {
                const cached = sessionStorage.getItem('site_config');
                if (cached) {
                    const data = JSON.parse(cached);
                    applyConfig(data);
                }

                try {
                    const res = await fetch('/config');
                    const latest = await res.json();

                    // Update cache if new version
                    if (!cached || JSON.parse(cached).version !== latest.version) {
                        sessionStorage.setItem('site_config', JSON.stringify(latest));
                        applyConfig(latest);
                    }
                } catch (err) {
                    console.error('Config fetch error:', err);
                }
            }

            document.addEventListener('DOMContentLoaded', loadConfig);
        });
        
    </script>

</body>
</html>
