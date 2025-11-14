@extends('layout.template-admin')

@section('breadcrumb')
    <!-- Breadcrumb Navigasi Halaman -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard">
                <svg class="stroke-icon">
                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="/wali-murid">Wali Murid</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')

    <!-- ============================
         FORM UNTUK MEMILIH SISWA
         ============================ -->
    <div class="col-sm-4 col-xxl-4 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        <div class="card">
            <div class="card-header">
                <h5>Pilih Siswa Wali Murid</h5>
            </div>

            <div class="card-body">
                <!-- Form input siswa yang akan ditambahkan ke wali murid -->
                <form class="row g-3 needs-validation custom-input" novalidate="">

                    <!-- Input: Dropdown Nama Siswa -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="namaSiswa">Nama Siswa</label>
                        <select name="namaSiswa" id="namaSiswa" class="form-select">
                            <option selected disabled>Pilih Siswa</option>
                            <option value="S001">Rafi Nur Maulana</option>
                            <option value="S002">Bella Arum Syafina</option>
                        </select>

                        <!-- Tooltip validasi -->
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid city.</div>
                    </div>

                    <!-- Tombol Form -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a class="btn btn-danger" href="/wali-murid">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- =======================================
         TABEL DAFTAR SISWA YANG SUDAH TERKAIT
         ======================================= -->
    <div class="col-xxl-8 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Daftar Siswa Wali Murid</h5>
                </div>
            </div>

            <div class="card-body px-0 pt-0 common-option">
                <!-- Tabel siswa terkait wali murid -->
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">

                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Siswa</th>
                                <th>Nama Siswa</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Contoh satu baris data siswa -->
                            <tr>
                                <td></td>
                                <td>S001</td>

                                <!-- Nama siswa + NIS -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <a class="f-14 mb-0 f-w-500 c-light" href="">Bella Arum Syafina</a>
                                            <p class="c-o-light">2202310099</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Aksi: dropdown menu -->
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>

                                        <!-- Menu dropdown aksi -->
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item text-danger" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
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
    </div>

@endsection
