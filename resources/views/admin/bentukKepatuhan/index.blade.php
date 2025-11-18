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
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')
    {{-- Tombol Tambah --}}
    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e mb-3 d-flex justify-content-end">
        <a href="#" class="btn btn-primary">Tambah Bentuk Kepatuhan</a>
    </div>

    <div class="card">
        <div class="card-header card-no-border">
            <div class="header-top">
                <h5>Daftar Bentuk Kepatuhan</h5>
            </div>
        </div>


        {{-- ===== KATEGORI SIKAP ===== --}}
        <div class="card mb-4">
            <div class="card-header" style="background:#e8f2ff;">
                <h5 class="mb-0 text-primary">Kategori Sikap</h5>
            </div>


            <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                <table class="table" id="main-recent-order">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID Kepatuhan</th>
                            <th>Nama Kepatuhan</th>
                            <th>Bobot Poin</th>
                            <th>Penghargaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>TK001</td>
                            <td>Menjadi teladan siswa berperilaku baik</td>
                            <td><span class="badge bg-success">+3 poin</span></td>
                            <td>Apresiasi Wali Kelas</td>
                            <!-- Aksi: dropdown menu -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <!-- Menu dropdown aksi -->
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa fa-edit me-2 text-primary"></i> Update
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="fa fa-trash me-2"></i> Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===== KATEGORI SOSIAL ===== --}}
        <div class="card mb-4">
            <div class="card-header" style="background:#e9f9ef;">
                <h5 class="mb-0 text-success">Kategori Sosial</h5>
            </div>


            <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                <table class="table" id="main-recent-order">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID Kepatuhan</th>
                            <th>Nama Kepatuhan</th>
                            <th>Bobot Poin</th>
                            <th>Pernghargaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>TK002</td>
                            <td>Aktif kegiatan OSIS/Ekskul</td>
                            <td><span class="badge bg-success">+10 poin</span></td>
                            <td>Tambahan Apresiasi</td>
                            <!-- Aksi: dropdown menu -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <!-- Menu dropdown aksi -->
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa fa-edit me-2 text-primary"></i> Update
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="fa fa-trash me-2"></i> Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
