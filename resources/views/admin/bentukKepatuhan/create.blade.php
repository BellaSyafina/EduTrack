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
            <a href="/bentuk-kepatuhan">Bentuk Kepatuhan</a>
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
                <h5>Form Bentuk Kepatuhan</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('bentuk-kepatuhan.store') }}"
                    method="POST" novalidate="">
                    @csrf

                    {{-- NIP --}}
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="id_kategori_kepatuhan">Kategori Kepatuhan</label>
                        <select name="id_kategori_kepatuhan" id="id_kategori_kepatuhan"
                            class="form-select @error('id_kategori_kepatuhan') is-invalid @enderror" required>
                            <option disabled selected>Pilih Kategori Kepatuhan</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori_kepatuhan }}"
                                    {{ old('id_kategori_kepatuhan') == $item->id_kategori_kepatuhan ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('id_kategori_pelanggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Kepatuhan --}}
                    <div class="col-md-4 position-relative">
                        <label class="form-label" for="nama_kepatuhan">Nama Kepatuhan</label>
                        <input class="form-control @error('nama_kepatuhan') is-invalid @enderror" id="nama_kepatuhan"
                            name="nama_kepatuhan" type="text" placeholder="Masukkan Nama Kepatuhan..."
                            value="{{ old('nama_kepatuhan') }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nama_kepatuhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-4 position-relative">
                        <label class="form-label" for="bobot_poin">Bobot Poin</label>
                        <input type="number" class="form-control @error('bobot_poin') is-invalid @enderror" id="bobot_poin"
                            name="bobot_poin" placeholder="Masukkan Bobot Poin..." value="{{ old('bobot_poin') }}"
                            required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('bobot_poin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 position-relative">
                        <label class="form-label" for="penghargaan">Penghargaan</label>
                        <input type="text" class="form-control @error('penghargaan') is-invalid @enderror" id="penghargaan"
                            name="penghargaan" placeholder="Masukkan Penghargaan..." value="{{ old('penghargaan') }}"
                            required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('penghargaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/bentuk-kepatuhan" class="btn btn-danger">Kembali</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
