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
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-12 col-xxl-12 col-lg-12 ord-xl-5 ord-md-6 box-ord-7 box-col-4e d-flex justify-content-end">
        <!-- Tombol Import -->
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fa fa-file-excel"></i> Import Excel
        </button>
    </div>

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('kelas.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload File Excel</label>
                        <input type="file" name="file" class="form-control" required>
                        <small class="text-muted">Format file: .xlsx / .xls</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-upload"></i> Upload
                    </button>
                </div>

            </form>
        </div>
    </div>


    <div class="col-sm-4-xxl-5 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e mt-3">
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
                <h5>Form Kelas</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('kelas.store') }}" method="POST"
                    novalidate="">
                    @csrf
                    {{-- Nama Kelas --}}
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="nama_guru">Nama Kelas</label>
                        <input class="form-control @error('nama_guru') is-invalid @enderror" id="nama_kelas"
                            name="nama_kelas" type="text" placeholder="Masukkan Nama Kelas..."
                            value="{{ old('nama_kelas') }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nama_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol dibuat sejajar di baris yang sama -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-xxl-8 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e mt-3">
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
                    <h5>Daftar Kelas</h5>
                </div>
            </div>
            <div class="card-body px-0 pt-0 common-option">
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Kelas</th>
                                <th>Nama Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ 'K' . str_pad($item->id_kelas, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <a class="f-14 mb-0 f-w-500 c-light"
                                                    href="">{{ $item->nama_kelas }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light p-2 btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="/kelas/{{ $item->id_kelas }}/edit">
                                                        <i class="fa fa-edit me-2 text-primary"></i> Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger"
                                                        href="/kelas/{{ $item->id_kelas }}/delete">
                                                        <i class="fa fa-trash me-2"></i> Delete
                                                    </a>
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
