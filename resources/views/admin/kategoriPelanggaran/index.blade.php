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
        <div class="card">
            <div class="card-header">
                <h5>Form Kategori Pelanggaran</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" novalidate="">
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="kategoriPelanggaran">Kategori Pelanggaran</label>
                        <input class="form-control" id="kategoriPelanggaran" type="text"
                            placeholder="Masukkan Kategori Pelanggaran..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid input.</div>
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
        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Daftar Kategori Pelanggaran</h5>
                </div>
            </div>

            <div class="card-body px-0 pt-0 common-option">
                <div class="recent-table table-responsive custom-scrollbar">
                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Kategori Pelanggaran</th>
                                <th>Kategori Pelanggaran</th>
                                <th>Bentuk Pelanggaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td></td>
                                <td>KP001</td>
                                <td>Pelanggaran Ringan</td>

                                <!-- Tombol Detail yang mengarah ke menu Bentuk Pelanggaran -->
                                <td>
                                    <a href="/bentuk-pelanggaran/KP001" class="btn btn-info btn-sm text-center">
                                        Detail
                                    </a>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="/kategori/edit/K001">
                                                    <i class="fa fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#">
                                                    <i class="fa fa-trash me-2"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>KP002</td>
                                <td>Pelanggaran Sedang</td>

                                <td>
                                    <a href="/bentuk-pelanggaran/KP002" class="btn btn-info btn-sm">
                                        Detail
                                    </a>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="/kategori/edit/K002">
                                                    <i class="fa fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#">
                                                    <i class="fa fa-trash me-2"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
