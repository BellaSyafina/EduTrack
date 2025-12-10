<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set karakter encoding dan kompatibilitas browser -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Informasi deskripsi website -->
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">

    <!-- Include judul halaman -->
    @include('components.title')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">

    <!-- Include file CSS utama -->
    @include('components.style')

    <!-- Stack tambahan CSS dari halaman lain -->
    @stack('style')
    <style>
        .page-body {
            position: relative;
            z-index: 1;
        }

        .page-body::before {
            content: "";
            position: fixed;
            /* ✅ ubah jadi fixed */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;

            background-image: url('{{ asset('assets/images/smpn.png') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 800px auto;
            opacity: 0.08;

            pointer-events: none;
            z-index: -1;
        }
    </style>


</head>

<body onload="startTime()">
    <!-- Loader saat halaman pertama terbuka -->
    <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>

    <!-- Tombol kembali ke atas -->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <!-- Wrapper utama halaman -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">

        <!-- Header / Navbar -->
        @include('components.header')

        <!-- Body halaman -->
        <div class="page-body-wrapper">

            <!-- Sidebar navigasi -->
            @include('components.sidebar')

            <!-- Konten utama -->
            <div class="page-body">

                <!-- Judul halaman -->
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>{{ $title }} </h3>
                            </div>

                            <!-- Breadcrumb opsional -->
                            <div class="col-sm-6">
                                @yield('breadcrumb')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontainer isi utama -->
                <div class="container-fluid default-dashboard">
                    <div class="row widget-grid">
                        @yield('content') <!-- Konten dinamis halaman -->
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('components.footer')

        </div>
    </div>

    <!-- Script JS utama -->
    @include('components.script')

    <!-- Tambahan script dari halaman lain -->
    @stack('script')
</body>

</html>
