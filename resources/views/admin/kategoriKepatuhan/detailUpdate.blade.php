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
            <a href="/kategori-kepatuhan">Data Kategori Kepatuhan</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/kategori-kepatuhan/{{ $kategori->id_kategori_kepatuhan }}/detail">Detail Kategori Kepatuhan</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-4 col-xxl-4 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        <div class="card">
            <div class="card-header">
                <h5>Form Update Bentuk Kepatuhan</h5>
            </div>

            <div class="card-body">
                <!-- Form input siswa yang akan ditambahkan ke wali murid -->
                <form class="row g-3 needs-validation custom-input"
                    action="{{ route('kategori-kepatuhan.detailUpdate', [$kategori->id_kategori_kepatuhan, $kepatuhan->id_kepatuhan]) }}" method="POST"
                    novalidate="">
                    @csrf
                    <!-- Input: Dropdown Nama Siswa -->
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="namaKepatuhan">Nama Kepatuhan</label>
                        <input type="text" class="form-control" name="nama_kepatuhan" id="namaKepatuhan" value="{{ $kepatuhan->nama_kepatuhan }}"
                            placeholder="Masukkan Nama Kepatuhan..." required>
                        <!-- Tooltip validasi -->
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="poin">Poin</label>
                        <input type="text" class="form-control" name="bobot_poin" id="poin" value="{{ $kepatuhan->bobot_poin }}"
                            placeholder="Masukkan Poin..." required>
                        <!-- Tooltip validasi -->
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>

                    <!-- Tombol Form -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="/kategori-kepatuhan/{{ $kategori->id_kategori_kepatuhan }}/detail">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
