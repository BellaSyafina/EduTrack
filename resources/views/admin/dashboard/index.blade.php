@extends('layout.template-admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <a href="">
                <svg class="stroke-icon">
                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
            </a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="col-xxl-4 col-sm-6 box-col-6">
        <div class="card profile-box">
            <div class="card-body">
                <div class="d-flex media-wrapper justify-content-between">
                    <div class="flex-grow-1">
                        <div class="greeting-user">
                            <h2 class="f-w-600">Welcome {{ Auth::user()->username }}!</h2>
                            <small class="text-white">SMPN 2 Saronggi</small>
                            <br>
                            <small class="text-white">tempatnya belajar, berprestasi, dan berkarakter.</small>
                            <div class="whatsnew-btn">
                                <a class="btn btn-outline-white" href="user-profile.html" target="_blank">View Profile</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="clockbox">
                            <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                                <g id="face">
                                    <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                                    <path class="hour-marks"
                                        d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6">
                                    </path>
                                    <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                                </g>
                                <g id="hour">
                                    <path class="hour-hand" d="M300.5 298V142"></path>
                                    <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                </g>
                                <g id="minute">
                                    <path class="minute-hand" d="M300.5 298V67"> </path>
                                    <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                </g>
                                <g id="second">
                                    <path class="second-hand" d="M300.5 350V55"></path>
                                    <circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
                                </g>
                            </svg>
                        </div>
                        <div class="badge f-10 p-0" id="txt"></div>
                    </div>
                </div>
                <div class="cartoon">
                    <img class="img-fluid" src="{{ asset('') }}assets/images/dashboard/cartoon.svg"
                        alt="vector women with leptop">
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role == 'Admin')
        <div class="col-xxl-2">
            <div class="card">
                <div class="card-header bg-primary text-white rounded shadow">
                    <h5>Total Siswa</h5>
                </div>

                <div class="card-body d-flex flex-column justify-content-center align-items-center position-relative"
                    style="min-height: 176px;">

                    <!-- Angka tetap di tengah -->
                    <h3 class="position-absolute top-45 start-50 translate-middle">{{ $totalSiswa }}</h3>

                    <!-- Deskripsi di bawah -->
                    <small class="text-muted mt-auto">Total siswa yang terdaftar</small>

                </div>
            </div>
        </div>
        <div class="col-xxl-2">
            <div class="card">
                <div class="card-header bg-success text-white rounded shadow">
                    <h5>Total Kelas</h5>
                </div>

                <div class="card-body d-flex flex-column justify-content-center align-items-center position-relative"
                    style="min-height: 176px;">

                    <!-- Angka tetap di tengah -->
                    <h3 class="position-absolute top-45 start-50 translate-middle">{{ $totalKelas }}</h3>

                    <!-- Deskripsi di bawah -->
                    <small class="text-muted mt-auto">Total kelas yang tersedia</small>

                </div>
            </div>
        </div>
        <div class="col-xxl-2">
            <div class="card">
                <div class="card-header bg-warning text-white rounded shadow">
                    <h5>Total Guru</h5>
                </div>

                <div class="card-body d-flex flex-column justify-content-center align-items-center position-relative"
                    style="min-height: 176px;">

                    <!-- Angka tetap di tengah -->
                    <h3 class="position-absolute top-45 start-50 translate-middle">{{ $totalGuru }}</h3>

                    <!-- Deskripsi di bawah -->
                    <small class="text-muted mt-auto">Total guru yang tersedia</small>

                </div>
            </div>
        </div>
        <div class="col-xxl-2">
            <div class="card">
                <div class="card-header bg-danger text-white rounded shadow">
                    <h5>Total Wali Murid</h5>
                </div>

                <div class="card-body d-flex flex-column justify-content-center align-items-center position-relative"
                    style="min-height: 176px;">

                    <!-- Angka tetap di tengah -->
                    <h3 class="position-absolute top-45 start-50 translate-middle">{{ $totalWaliMurid }}</h3>

                    <!-- Deskripsi di bawah -->
                    <small class="text-muted mt-auto">Total wali murid yang tersedia</small>

                </div>
            </div>
        </div>

        <div class="col-xxl-6 mb-3">
            <div class="card shadow p-3" style="height: 400px;"> <!-- Tinggi card -->
                <h5 class="text-center mb-3">Grafik Pelanggaran per Bulan</h5>

                <!-- wrapper chart wajib punya tinggi -->
                <div style="height: 520px;">
                    <canvas id="grafikPelanggaranAdmin"></canvas>
                </div>

            </div>
        </div>

        <div class="col-xxl-6 mb-3">
            <div class="card shadow p-3" style="height: 400px;"> <!-- Tinggi card -->
                <h5 class="text-center mb-3">Grafik Kepatuhan per Bulan</h5>

                <!-- wrapper chart wajib punya tinggi -->
                <div style="height: 520px;">
                    <canvas id="grafikKepatuhanAdmin"></canvas>
                </div>

            </div>
        </div>

        <div class="col-xxl-6 mb-3">
            <div class="card shadow p-3">
                <h5>Pelanggaran Terbaru Hari Ini</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Pelanggaran</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggaranTerbaru as $item)
                            <tr>
                                <td>{{ $item->siswa->nama_siswa }}</td>
                                <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>
                                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-xxl-6 mb-3">
            <div class="card shadow p-3">
                <h5>Kepatuhan Terbaru Hari Ini</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Kepatuhan</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kepatuhanTerbaru as $item)
                            <tr>
                                <td>{{ $item->siswa->nama_siswa }}</td>
                                <td>{{ $item->kepatuhan->nama_kepatuhan }}</td>
                                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif (Auth::user()->role == 'Wali Kelas')
        {{--  @dd($dataPelanggaranWaliKelas)  --}}
        <div class="col-xxl-8">
            <div class="row">
                {{--  <div class="col-xxl-6 mb-3">
                    <div class="card shadow p-3" style="height: 300px;"> <!-- Tinggi card -->
                        <h5 class="text-center mb-3">Grafik Pelanggaran Kelas</h5>

                        <!-- wrapper chart wajib punya tinggi -->
                        <div style="height: 520px;">
                            <canvas id="grafikPelanggaranWaliKelas"></canvas>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-6 mb-3">
                    <div class="card shadow p-3">
                        <h5 class="text-center">Grafik Kepatuhan Kelas</h5>
                        <canvas id="grafikKepatuhanWaliKelas" class="chart-fixed"></canvas>
                    </div>
                </div>  --}}
                <div class="col-xxl-6 mb-3">
                    <div class="card shadow p-3">
                        <h5>Pelanggaran Terbaru Kelas</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Pelanggaran</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggaranTerbaruWaliKelas as $item)
                                    <tr>
                                        <td>{{ $item->siswa->nama_siswa }}</td>
                                        <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xxl-6 mb-3">
                    <div class="card shadow p-3">
                        <h5>Kepatuhan Terbaru Kelas</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Kepatuhan</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kepatuhanTerbaruWaliKelas as $item)
                                    <tr>
                                        <td>{{ $item->siswa->nama_siswa }}</td>
                                        <td>{{ $item->kepatuhan->nama_kepatuhan }}</td>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @elseif (Auth::user()->role == 'Wali Murid')
        <div class="col-xxl-8 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-white rounded shadow">
                    <h5>Profil Anak</h5>
                </div>

                @if ($siswaList->count() == 1)
                    @php $anak = $siswaList->first()->siswa; @endphp

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-2"><strong>Nama:</strong></div>
                            <div class="col-md-6">{{ $anak->nama_siswa }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2"><strong>Kelas:</strong></div>
                            <div class="col-md-6">{{ $anak->kelas->nama_kelas }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2"><strong>Total Pelanggaran:</strong></div>
                            <div class="col-md-6">{{ $totalPelanggaranWaliMurid }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2"><strong>Total Kepatuhan:</strong></div>
                            <div class="col-md-6">{{ $totalKepatuhanWaliMurid }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2"><strong>Status Kepatuhan:</strong></div>
                            <div class="col-md-6">
                                @if ($totalKepatuhanWaliMurid >= $totalPelanggaranWaliMurid)
                                    Patuh
                                @else
                                    Tidak Patuh
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Jika punya banyak anak --}}
                    @foreach ($siswaList as $item)
                        @php $anak = $item->siswa; @endphp

                        <div class="card shadow-sm p-3 mb-3 border">

                            <div class="row mb-2">
                                <div class="col-md-2"><strong>Nama:</strong></div>
                                <div class="col-md-6">{{ $anak->nama_siswa }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2"><strong>Kelas:</strong></div>
                                <div class="col-md-6">{{ $anak->kelas->nama_kelas }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2"><strong>Total Pelanggaran:</strong></div>
                                <div class="col-md-6">{{ $anak->dataPelanggaran()->count() }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2"><strong>Total Kepatuhan:</strong></div>
                                <div class="col-md-6">{{ $anak->dataKepatuhan()->count() }}</div>
                            </div>

                            @php
                                $pel = $anak->dataPelanggaran()->count();
                                $kep = $anak->dataKepatuhan()->count();
                            @endphp

                            <div class="row mb-2">
                                <div class="col-md-6"><strong>Status Kepatuhan:</strong></div>
                                <div class="col-md-6">
                                    @if ($kep >= $pel)
                                        Patuh
                                    @else
                                        Tidak Patuh
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <div class="col-xxl-6 mb-3">
            <div class="card">
                <div class="card-header bg-danger text-white rounded shadow">
                    <h5>Riwayat Pelanggaran Anak</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pelanggaran</th>
                                <th>Tingkat</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPelanggaran as $item)
                                <tr>
                                    <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>
                                    <td>{{ $item->pelanggaran->kategoriPelanggaran->nama_kategori ?? '' }}</td>
                                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 mb-3">
            <div class="card">
                <div class="card-header bg-success text-white rounded shadow">
                    <h5>Riwayat Kepatuhan Anak</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatKepatuhan as $item)
                                <tr>
                                    <td>{{ $item->kepatuhan->nama_kepatuhan }}</td>
                                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('style')
    <style>
        .chart-fixed {
            max-height: 250px !important;
            height: 250px !important;
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const dataPelanggaran = @json($dataPelanggaran);

            const ctx = document.getElementById("grafikPelanggaranAdmin").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Jumlah Siswa Melakukan Pelanggaran",
                        data: dataPelanggaran,
                        borderWidth: 1,
                        backgroundColor: "rgba(255, 0, 0, 0.7)", // merah transparan
                        borderColor: "rgba(255, 0, 0, 1)" // merah solid
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // Grafik Kepatuhan
            const dataKepatuhan = @json($dataKepatuhan);

            const ctxKepatuhan = document.getElementById("grafikKepatuhanAdmin").getContext("2d");

            new Chart(ctxKepatuhan, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Jumlah Siswa Melakukan Kepatuhan",
                        data: dataKepatuhan,
                        borderWidth: 1,
                        backgroundColor: "rgba(0, 128, 0, 0.7)", // hijau transparan
                        borderColor: "rgba(0, 128, 0, 1)" // hijau solid
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            const dataPelanggaranWaliKelas = @json($dataPelanggaranWaliKelas);

            if (document.getElementById("grafikPelanggaranWaliKelas")) {
                const ctx = document
                    .getElementById("grafikPelanggaranWaliKelas")
                    .getContext("2d");

                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Jumlah Siswa Melakukan Pelanggaran",
                            data: dataPelanggaranWaliKelas,
                            backgroundColor: "rgba(255, 0, 0, 0.7)",
                            borderColor: "rgba(255, 0, 0, 1)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

        });
    </script>
@endpush
