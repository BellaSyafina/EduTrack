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
    <div class="col-sm-4 col-lg-4">
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
                <h5>Form Kategori Pelanggaran</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input"
                    action="{{ route('kategori-pelanggaran.update', ['id' => $kategori->id_kategori_pelanggaran]) }}"
                    method="POST" novalidate="">
                    @csrf
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="kategoriPelanggaran">Kategori Pelanggaran</label>
                        <input class="form-control" id="kategoriPelanggaran" type="text" name="nama_kategori"
                            value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                            placeholder="Masukkan Kategori Pelanggaran..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid input.</div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="dariPoin">Dari Poin</label>
                        <input class="form-control" id="dariPoin" type="number" name="dari_poin"
                            value="{{ old('dari_poin', $kategori->dari_poin) }}" placeholder="Masukkan Dari Poin..."
                            readonly required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="sampaiPoin">Sampai Poin</label>
                        <input class="form-control" id="sampaiPoin" type="number" name="sampai_poin"
                            value="{{ old('sampai_poin', $kategori->sampai_poin) }}" placeholder="Masukkan Sampai Poin..."
                            @unless ($isLast) readonly @endunless required>
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>

                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/kategori-pelanggaran" class="btn btn-danger">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
