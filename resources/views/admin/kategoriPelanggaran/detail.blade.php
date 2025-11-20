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
        <li class="breadcrumb-item">
            <a href="/kategori-pelanggaran">Data Kategori Pelanggaran</a>
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
                <h5>Form Tambah Bentuk Pelanggaran</h5>
            </div>

            <div class="card-body">
                <!-- Form input siswa yang akan ditambahkan ke wali murid -->
                <form class="row g-3 needs-validation custom-input" action="{{ route('kategori-pelanggaran.detail', $kategori->id_kategori_pelanggaran) }}" method="POST" novalidate="">
                    @csrf
                    <!-- Input: Dropdown Nama Siswa -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="namaPelanggaran">Nama Pelanggaran</label>
                        <input type="text" class="form-control" name="nama_pelanggaran" id="namaPelanggaran" placeholder="Masukkan Nama Pelanggaran..." required>
                        <!-- Tooltip validasi -->
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="poin">Poin</label>
                        <input type="text" class="form-control" name="bobot_poin" id="poin" placeholder="Masukkan Poin..." required>
                        <!-- Tooltip validasi -->
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>

                    <!-- Tombol Form -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a class="btn btn-danger" href="/kategori-pelanggaran">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- =======================================
                                TABEL DAFTAR SISWA YANG SUDAH TERKAIT
                                ======================================= -->
    <div class="col-xxl-8 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-bg-success light alert-dismissible fade show txt-success border-left-success"
                role="alert">
                <i data-feather="check-square"></i>
                <p>{{ session('success') }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                role="alert">
                <i data-feather="alert-triangle"></i>
                <p>{{ session('error') }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Daftar Bentuk Pelanggaran {{ $kategori->nama_kategori }}</h5>
                </div>
            </div>

            <div class="card-body px-0 pt-0 common-option">
                <!-- Tabel siswa terkait wali murid -->
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">

                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Bentuk Pelanggaran</th>
                                <th>Nama Pelanggaran</th>
                                <th>Bobot Poin</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pelanggaran as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ 'BP' . str_pad($item->id_pelanggaran, 3, '0', STR_PAD_LEFT) }}</td>

                                    <!-- Nama siswa + NIS -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <a class="f-14 mb-0 f-w-500 c-light"
                                                    href="">{{ $item->nama_pelanggaran }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->bobot_poin < 0 ? 'bg-danger' : 'bg-success' }}">
                                            {{ $item->bobot_poin > 0 ? '+' . $item->bobot_poin : $item->bobot_poin }} poin
                                        </span>
                                    </td>

                                    <!-- Aksi: dropdown menu -->
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light p-2 btn-sm" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>

                                            <!-- Menu dropdown aksi -->
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="/kategori-pelanggaran/{{ $kategori->id_kategori_pelanggaran }}/detail/{{ $item->id_pelanggaran }}/edit">
                                                        <i class="fa fa-edit me-2 text-primary"></i> Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('kategori-pelanggaran.detailDestroy', [$kategori->id_kategori_pelanggaran, $item->id_pelanggaran]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger"
                                                            onclick="return confirm('Hapus bentuk pelanggaran ini?')">
                                                            <i class="fa fa-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
