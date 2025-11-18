@extends('layout.template-admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard">
                <svg class="stroke-icon">
                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
            </a>
        </li>
        <li class="breadcrumb-item active">Laporan</li>
    </ol>
@endsection


@section('content')
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="fw-bold">Laporan</h4>

            <a href="#" class="btn btn-success">
                <i class="fa fa-file-pdf me-1"></i> Export PDF
            </a>
        </div>

        {{-- SEARCH & FILTER --}}
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Cari laporan...">
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Filter Kelas</option>
                    <option>VII - A</option>
                    <option>VII - B</option>
                    <option>VII - C</option>
                    <option>VII - D</option>

                    <option>VIII - A</option>
                    <option>VIII - B</option>
                    <option>VIII - C</option>

                    <option>IX - A</option>
                    <option>IX - B</option>
                    <option>IX - C</option>
                    <option>IX - D</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Filter Jenis</option>
                    <option>Pelanggaran</option>
                    <option>Kepatuhan</option>
                </select>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Pelanggaran</th>
                        <th>Jenis Kepatuhan</th>
                        <th>Bobot</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- Contoh Data --}}
                    <tr>
                        <td>1</td>
                        <td>Ahmad Rizki</td>
                        <td>IX-B</td>
                        <td>Terlambat masuk sekolah</td>
                        <td>-</td>
                        <td><span class="badge bg-danger">-5</span></td>
                        <td>25/10/2025</td>
                        <td>
                            <a href="#" class="btn btn-outline-primary btn-sm">Detail</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Bella Safira</td>
                        <td>IX-A</td>
                        <td>-</td>
                        <td>Hadir tepat waktu 1 bulan</td>
                        <td><span class="badge bg-success">+20</span></td>
                        <td>25/10/2025</td>
                        <td>
                            <a href="#" class="btn btn-outline-primary btn-sm">Detail</a>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>
@endsection
