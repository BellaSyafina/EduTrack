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
            <a href="/sanksi-pelanggaran">Sanksi Pelanggaran</a>
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
                <h5>Form Sanksi Pelanggaran</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('sanksi-pelanggaran.store') }}"
                    method="POST" novalidate="">
                    @csrf

                    {{-- NIP --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="id_kategori_pelanggaran">Kategori Pelanggaran</label>
                        <select name="id_kategori_pelanggaran" id="id_kategori_pelanggaran"
                            class="form-select @error('id_kategori_pelanggaran') is-invalid @enderror" required>
                            <option disabled selected>Pilih Kategori Pelanggaran</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori_pelanggaran }}"
                                    {{ old('id_kategori_pelanggaran') == $item->id_kategori_pelanggaran ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('id_kategori_pelanggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Pelanggaran --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="nama_sanksi">Nama Sanksi</label>
                        <input class="form-control @error('nama_sanksi') is-invalid @enderror" id="nama_sanksi"
                            name="nama_sanksi" type="text" placeholder="Masukkan Nama Sanksi..."
                            value="{{ old('nama_sanksi') }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nama_sanksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/sanksi-pelanggaran" class="btn btn-danger">Kembali</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
