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
            <a href="/kelas">Data Kelas</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-4-xxl-5 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        <div class="card">
            <div class="card-header">
                <h5>Form Kelas</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('kelas.update', $kelas->id_kelas) }}"
                    method="POST" novalidate="">
                    @csrf
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="namaKelas">Nama Kelas</label>
                        <input class="form-control" id="nama_kelas" name="nama_kelas" type="text"
                            value="{{ $kelas->nama_kelas }}" placeholder="Masukkan Nama Kelas..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid city.</div>
                    </div>

                    <!-- Tombol dibuat sejajar di baris yang sama -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a class="btn btn-danger" href="/kelas">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
