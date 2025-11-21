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
            <a href="/bentuk-pelanggaran">Bentuk Pelanggaran</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-12 col-xxl-12 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        {{-- Alert Validasi --}}
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
                <h5>Form Bentuk Pelanggaran</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input"
                    action="{{ route('bentuk-pelanggaran.update', $pelanggaran->id_pelanggaran) }}" method="POST"
                    novalidate="">
                    @csrf

                    {{-- NIP --}}
                    <div class="col-md-12 position-relative">
                        <label class="form-label">Kategori Pelanggaran</label>

                        {{-- Display text (readonly) --}}
                        <input type="text" class="form-control" value="{{ $pelanggaran->kategoriPelanggaran->nama_kategori }}"
                            readonly>

                        {{-- Hidden input to submit the original value --}}
                        <input type="hidden" name="id_kategori_pelanggaran"
                            value="{{ $pelanggaran->id_kategori_pelanggaran }}">
                    </div>


                    {{-- Nama Pelanggaran --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="nama_pelanggaran">Nama Pelanggaran</label>
                        <input class="form-control @error('nama_pelanggaran') is-invalid @enderror" id="nama_pelanggaran"
                            name="nama_pelanggaran" type="text" placeholder="Masukkan Nama Pelanggaran..."
                            value="{{ old('nama_pelanggaran', $pelanggaran->nama_pelanggaran) }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nama_pelanggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="bobot_poin">Bobot Poin</label>
                        <input type="number" class="form-control @error('bobot_poin') is-invalid @enderror" id="bobot_poin"
                            name="bobot_poin" placeholder="Masukkan Bobot Poin..."
                            value="{{ old('bobot_poin', $pelanggaran->bobot_poin) }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('bobot_poin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/bentuk-pelanggaran" class="btn btn-danger">Kembali</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
