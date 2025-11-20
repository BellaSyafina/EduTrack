@extends('layout.template-admin')

{{-- Breadcrumb Navigasi --}}
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
            <a href="/wali-murid">Wali Murid</a>
        </li>
        {{-- Judul halaman otomatis dari controller --}}
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-12 col-xxl-12 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        @if ($errors->any())
            <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                role="alert">
                <i data-feather="alert-triangle"></i>
                <p>{{ $errors->first() }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h5>Form Wali Murid</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input"
                    action="{{ route('wali-murid.update', $waliMurid->id_wali_murid) }}" method="POST" novalidate="">
                    @csrf
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="nama_wali_murid">Nama Wali Murid</label>
                        <input class="form-control" id="nama_wali_murid" name="nama_wali_murid" type="text"
                            value="{{ $waliMurid->nama_wali_murid }}" placeholder="Masukkan Nama Wali Murid..."
                            required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid city.</div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="text"
                            value="{{ $waliMurid->user->email }}" placeholder="Masukkan Email Wali Murid..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid city.</div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="no_hp">No Telepon</label>
                        <input class="form-control" id="no_hp" name="no_hp" type="text"
                            value="{{ $waliMurid->no_hp }}" placeholder="Masukkan No Telepon..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid city.</div>
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control">{{ $waliMurid->alamat }}</textarea>
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid city.</div>
                    </div>

                    <!-- Tombol dibuat sejajar di baris yang sama -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/wali-murid" class="btn btn-danger">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
