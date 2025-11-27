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
    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e mb-3 d-flex justify-content-end">
        <a href="/wali-Kelas/tambah" class="btn btn-primary">Tambah Wali Kelas</a>
    </div>

    <div class="col-sm-4 col-xxl-4 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        {{-- Alert Validasi --}}
        @if ($errors->any())
            <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger" role="alert">
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
                <form class="row g-3 needs-validation custom-input" action="{{ route('wali-kelas.store') }}" method="POST"
                    novalidate="">
                    @csrf
                    {{-- Nama Kelas --}}
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="id_guru">Cari Guru</label>
                        <select class="form-select @error('id_guru') is-invalid @enderror" id="id_guru"
                            name="id_guru" required>
                            <option value="" disabled selected>-- Pilih Guru --</option>
                            @foreach ($guru as $item)
                                <option value="{{ $item->id_guru }}"
                                    {{ old('id_guru') == $item->id_guru ? 'selected' : '' }}>
                                    {{ $item->nama_guru }} - {{ $item->nip }}</option>
                            @endforeach
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('id_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="id_kelas">Cari Kelas</label>
                        <select class="form-select @error('id_kelas') is-invalid @enderror" id="id_kelas"
                            name="id_kelas" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id_kelas }}"
                                    {{ old('id_kelas') == $item->id_kelas ? 'selected' : '' }}>
                                    {{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('id_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol dibuat sejajar di baris yang sama -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
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
                    <h5>Daftar Wali Kelas</h5>
                </div>
            </div>
            <div class="card-body px-0 pt-0 common-option">
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Wali Kelas</th>
                                <th>Nama Wali Kelas</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($waliKelas as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ 'WK' . str_pad($item->id_wali_kelas, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <a class="f-14 mb-0 f-w-500 c-light"
                                                    href="">{{ $item->guru->nama_guru }}</a>
                                                <p class="c-o-light">{{ $item->guru->nip }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>
                                    <td>{{ $item->guru->alamat }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>{{ $item->user->dummy_password }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light p-2 btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="{{ route('wali-kelas.destroy', $item->id_wali_kelas) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger"
                                                            onclick="return confirm('Hapus wali kelas ini?')">
                                                            <i class="fa fa-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
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
