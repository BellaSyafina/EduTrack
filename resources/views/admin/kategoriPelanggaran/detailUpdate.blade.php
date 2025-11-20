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
        <li class="breadcrumb-item">
            <a href="/kategori-pelanggaran/{{ $kategori->id_kategori_pelanggaran }}/detail">Bentuk Pelanggaran {{ $kategori->nama_kategori }}</a>
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
                <form class="row g-3 needs-validation custom-input" action="{{ route('kategori-pelanggaran.detailUpdate', [$kategori->id_kategori_pelanggaran, $pelanggaran->id_pelanggaran]) }}" method="POST" novalidate="">
                    @csrf
                    <!-- Input: Dropdown Nama Siswa -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="namaPelanggaran">Nama Pelanggaran</label>
                        <input type="text" class="form-control" name="nama_pelanggaran" id="namaPelanggaran" value="{{ $pelanggaran->nama_pelanggaran }}" placeholder="Masukkan Nama Pelanggaran..." required>
                        <!-- Tooltip validasi -->
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="poin">Poin</label>
                        <input type="text" class="form-control" name="bobot_poin" id="poin" value="{{ $pelanggaran->bobot_poin }}" placeholder="Masukkan Poin..." required>
                        <!-- Tooltip validasi -->
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>

                    <!-- Tombol Form -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a class="btn btn-danger" href="/kategori-pelanggaran/{{ $kategori->id_kategori_pelanggaran }}/detail">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
