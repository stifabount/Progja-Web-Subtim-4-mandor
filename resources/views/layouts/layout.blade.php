<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Perapakan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('/image/Sambas Logo compress 300x300.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@400;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .toast {
            border-radius: 15px !important;
        }  
    </style>
</head>

<body>
    <!-- Navbar -->
    <section id="navbar">
        <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top navbar-transparent">
            <div class="container-fluid">
                <a class="navbar-brand ms-3 d-flex align-items-center" href="/">
                    <img id="logo" src="{{ asset('image/Sambas Logo.png') }}" width="40" class="me-3"
                        alt="Logo">
                    <span class="logo-text d-flex flex-column">
                        <strong class="nama_desa">Desa Perapakan</strong>
                        <small class="nama_kecamatan">Kecamatan Pemangkat</small>
                    </span>
                </a>

                <!-- Toggler for Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('profile-desa') ? 'active' : '' }}"
                                href="/profile-desa">Profil Desa</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Request::is('perangkat-desa', 'lembaga-desa') ? 'active' : '' }}"
                                href="#" id="pemerintahan-desa" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Pemerintahan Desa
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/perangkat-desa">Perangkat Desa</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/lembaga-desa">Lembaga Desa</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Request::is('layanan-administrasi', 'daftar-pengumuman', 'daftar-kegiatan') ? 'active' : '' }}"
                                href="#" id="informasi-publik" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Informasi Publik
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/layanan-administrasi">Layanan Administrasi</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/daftar-pengumuman">Pengumuman</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/daftar-kegiatan">Kegiatan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('layanan-publik') ? 'active' : '' }}"
                                href="/layanan-publik">Layanan Publik</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Floating Chatbot Button -->
        <a href="https://pemangkat-chatbot.streamlit.app/" target="_blank" id="chatbotBtn" class="btn btn-primary">
            <i class="fas fa-comments"></i> <!-- Chat icon (can be replaced with your own icon) -->
        </a>
    </section>

    </section>
    <!-- End of Navbar -->
    <!-- End of Banner -->

    <!-- Content -->
    @yield('child')
    <!-- End of Kantor Desa -->

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Tentang Desa</h5>
                    <p>
                        Perapakan adalah salah satu desa yang berada Kecamatan Pemangkat, Kabupaten Sambas.
                    </p>
                </div>
                <!-- Quick Links Section -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Jelajahi</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white text-decoration-none">Beranda</a></li>
                        <li><a href="/profile-desa" class="text-white text-decoration-none">Profil Desa</a></li>
                        <li><a href="/layanan-publik" class="text-white text-decoration-none">Layanan Publik</a></li>
                    </ul>
                </div>
                <!-- Contact Section -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Hubungi Kami</h5>
                    <p>
                        <i class="fas fa-phone-alt me-2"></i>{{ $kontak->no_hp }}<br>
                        <i class="fas fa-envelope me-2"></i>{{ $kontak->email }}<br>
                        <i class="fas fa-map-marker-alt me-2"></i>Jalan Mohammad.Sohor No.35 A Pemangkat
                    </p>
                    <div>
                        <a href="{{ $kontak->url_fb }}" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $kontak->url_ig }}" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $kontak->url_yt }}" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p class="mb-0">Copyright &copy; {{ date('Y') }} <span id="nama_desa"></span> All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
   <script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('mainNavbar');

        // Navbar transparency toggle
        const updateNavbarTransparency = () => {
            if (window.scrollY === 0) {
                navbar.classList.add('navbar-transparent');
                navbar.classList.remove('navbar-solid');
            } else {
                navbar.classList.add('navbar-solid');
                navbar.classList.remove('navbar-transparent');
            }
        };
        updateNavbarTransparency();
        window.addEventListener('scroll', updateNavbarTransparency);

        // Scroll reveal animation
        const checkPosition = () => {
            document.querySelectorAll('.transition-container').forEach(container => {
                const containerPosition = container.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                if (containerPosition < screenPosition) {
                    container.classList.add('show');
                }
            });
        };
        document.addEventListener('scroll', checkPosition);
        checkPosition();

        // Animated counter
        document.querySelectorAll(".counter").forEach(counter => {
            const updateCounter = () => {
                const target = +counter.getAttribute("data-target");
                const count = +counter.innerText;
                const increment = target / 400;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCounter, 10);
                } else {
                    counter.innerText = target;
                }
            };
            updateCounter();
        });

        // ==========================
        // CONFIG CACHE HANDLING
        // ==========================

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

    });

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
</script>
    @yield('kodejsenduser')

</body>

</html>
