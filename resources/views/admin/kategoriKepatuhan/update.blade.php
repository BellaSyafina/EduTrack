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
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-4 col-lg-4">
        @if ($errors->any())
            <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger" role="alert">
                <i data-feather="alert-triangle"></i>
                <p>{{ $errors->first() }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Form Kategori Kepatuhan</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('kategori-kepatuhan.update', $kategoriKepatuhan->id_kategori_kepatuhan) }}"
                    method="POST" novalidate="">
                    @csrf
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="kategoriKepatuhan">Kategori Kepatuhan</label>
                        <input class="form-control" id="kategoriKepatuhan" name="nama_kategori" type="text" value="{{ $kategoriKepatuhan->nama_kategori }}"
                            placeholder="Masukkan Kategori Kepatuhan..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>

                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/kategori-kepatuhan" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
