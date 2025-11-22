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
                <h5>Form Kategori Pelanggaran</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('kategori-pelanggaran.store') }}"
                    method="POST" novalidate="">
                    @csrf
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="kategoriPelanggaran">Kategori Pelanggaran</label>
                        <input class="form-control" id="kategoriPelanggaran" type="text" name="nama_kategori"
                            placeholder="Masukkan Kategori Pelanggaran..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="dariPoin">Dari Poin</label>
                        <input class="form-control" id="dariPoin" type="number" name="dari_poin" value="{{ $nextNumber }}"
                            placeholder="Masukkan Dari Poin..." readonly required="">
                        <input type="hidden" name="poin" value="{{ $nextNumber }}">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="sampaiPoin">Sampai Poin</label>
                        <input class="form-control" id="sampaiPoin" type="number" name="sampai_poin"
                            placeholder="Masukkan Sampai Poin..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>

                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-xxl-8 col-lg-8">
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
                    <h5>Daftar Kategori Pelanggaran</h5>
                </div>
            </div>

            <div class="card-body px-0 pt-0 common-option">
                <!-- Tabel Kategori Pelanggaran terkait Bentuk Pelanggaran -->
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">

                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Kategori Pelanggaran</th>
                                <th>Kategori Pelanggaran</th>
                                <th>Bobot Poin</th>
                                <th>Bentuk Pelanggaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Contoh satu baris data kategori pelanggaran -->
                            @foreach ($kategoriPelanggaran as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ 'KP' . str_pad($item->id_kategori_pelanggaran, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>
                                        <span class="badge bg-primary text-white px-2 py-1" style="font-size: 13px;">
                                            Bobot {{ $item->dari_poin }}–{{ $item->sampai_poin }} Poin
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/kategori-pelanggaran/{{ $item->id_kategori_pelanggaran }}/detail"
                                            class="btn btn-outline-primary btn-sm">Detail</a>
                                    </td>

                                    <!-- Aksi: dropdown menu -->
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light p-2 btn-sm" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>

                                            <!-- Menu dropdown aksi -->
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="/kategori-pelanggaran/{{ $item->id_kategori_pelanggaran }}/edit">
                                                        <i class="fa fa-edit me-2 text-primary"></i> Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('kategori-pelanggaran.destroy', ['id' => $item->id_kategori_pelanggaran]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger"
                                                            onclick="return confirm('Hapus kategori pelanggaran ini?')">
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
