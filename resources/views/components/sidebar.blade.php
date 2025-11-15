<!-- ============================
     SIDEBAR WRAPPER
     ============================ -->
<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>

        <!-- Logo utama (versi terang & gelap) -->
        <div class="logo-wrapper">
            <a href="">
                <img class="img-fluid for-light" src="{{ asset('') }}assets/images/logo/logo.png" alt="">
                <img class="img-fluid for-dark" src="{{ asset('') }}assets/images/logo/logo_dark.png" alt="">
            </a>

            <!-- Tombol kembali (mobile) -->
            <div class="back-btn">
                <i class="fa-solid fa-angle-left"></i>
            </div>

            <!-- Tombol toggle sidebar -->
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
            </div>
        </div>

        <!-- Logo kecil (icon sidebar ketika collapsed) -->
        <div class="logo-icon-wrapper">
            <a href="">
                <img class="img-fluid" src="{{ asset('') }}assets/images/logo/logo-icon.png" alt="">
            </a>
        </div>

        <!-- ============================
             NAVIGATION (MENU)
             ============================ -->
        <nav class="sidebar-main">

            <!-- Navigasi panah kiri (scroll menu) -->
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">

                    <!-- Logo kecil pada mode mobile -->
                    <li class="back-btn">
                        <a href="">
                            <img class="img-fluid" src="{{ asset('') }}assets/images/logo/logo-icon.png"
                                alt="">
                        </a>
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa-solid fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    <!-- Bagian pinned -->
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>

                    <!-- Group General -->
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>

                    <!-- Menu Dashboard -->
                    <li class="sidebar-list">
                        <i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="/dashboard">
                            <svg class="stroke-icon">
                                <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg>
                            <span class="">Dashboard </span>
                        </a>
                    </li>

                    <!-- ============================
                         MENU UNTUK ROLE ADMIN
                         ============================ -->
                    @if (Auth::user()->role === 'admin')
                        <!-- Judul group -->
                        <li class="sidebar-main-title">
                            <div>
                                <h6 class="">Kelola Data</h6>
                            </div>
                        </li>

                        <!-- Data Kelas -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"> </i>
                            <a class="sidebar-link sidebar-title link-nav" href="/kelas">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-project"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-project"></use>
                                </svg>
                                <span>Data Kelas </span>
                            </a>
                        </li>

                        <!-- Data Siswa -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"> </i>
                            <a class="sidebar-link sidebar-title link-nav" href="/siswa">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-project"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-project"></use>
                                </svg>
                                <span>Data Siswa </span>
                            </a>
                        </li>

                        <!-- Data Guru -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="/guru">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-file"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-file"></use>
                                </svg>
                                <span>Data Guru</span>
                            </a>
                        </li>

                        <!-- Data Wali Murid -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"> </i>
                            <a class="sidebar-link sidebar-title link-nav" href="/wali-murid">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-board"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-board"></use>
                                </svg>
                                <span>Data Wali Murid</span>
                            </a>
                        </li>

                        <!-- Kelola Pelanggaran -->
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Kelola Data Pelanggaran</h6>
                            </div>
                        </li>

                        <!-- Kategori Pelanggaran -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="/kategori-pelanggaran">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-form"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-form"> </use>
                                </svg>
                                <span>Kategori Pelanggaran</span>
                            </a>
                        </li>

                        <!-- Bentuk Pelanggaran -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="#">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-table"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-table"></use>
                                </svg>
                                <span>Bentuk Pelanggaran</span>
                            </a>
                        </li>

                        <!-- Sanksi Pelanggaran -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="#">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-table"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-table"></use>
                                </svg>
                                <span>Sanksi Pelanggaran</span>
                            </a>
                        </li>

                        <!-- Data Kepatuhan -->
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Kelola Data Kepatuhan</h6>
                            </div>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="#">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-ui-kits"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-ui-kits"></use>
                                </svg>
                                <span>Kategori Kepatuhan</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="#">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-bonus-kit"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-bonus-kit"></use>
                                </svg>
                                <span>Bentuk Kepatuhan</span>
                            </a>
                        </li>
                    @endif

                    <!-- ============================
                         MENU ROLE ADMIN & WALI KELAS
                         ============================ -->
                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'wali kelas')
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Kelola Input</h6>
                            </div>
                        </li>

                        <!-- Input Kepatuhan -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="landing-page.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-landing-page">
                                    </use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-landing-page"></use>
                                </svg>
                                <span>Input Kepatuhan Siswa</span>
                            </a>
                        </li>

                        <!-- Input Pelanggaran -->
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="sample-page.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-sample-page">
                                    </use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-sample-page"></use>
                                </svg>
                                <span>Input Pelanggaran Siswa</span>
                            </a>
                        </li>
                    @endif

                    <!-- Bagian Other -->
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Other</h6>
                        </div>
                    </li>

                    <!-- Menu Laporan -->
                    <li class="sidebar-list">
                        <i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-gallery"></use>
                            </svg>
                            <span>Laporan</span>
                        </a>
                    </li>

                    <!-- Pengguna Sistem (khusus admin) -->
                    @if (Auth::user()->role === 'admin')
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="#">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-blog"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#fill-blog"></use>
                                </svg>
                                <span>Pengguna Sistem</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>

            <!-- Navigasi panah kanan (scroll menu) -->
            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>

        </nav>
    </div>
</div>
