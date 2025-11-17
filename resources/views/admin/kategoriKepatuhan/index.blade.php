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
                <h5>Form Kategori Kepatuhan</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" novalidate="">
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="kategoriKepatuhan">Kategori Kepatuhan</label>
                        <input class="form-control" id="kategoriKepatuhan" type="text"
                            placeholder="Masukkan Kategori Kepatuhan..." required="">
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
                    <h5>Daftar Kategori Kepatuhan</h5>
                </div>
            </div>

            <div class="card-body px-0 pt-0 common-option">
                <!-- Tabel Kategori Kepatuhan terkait Bentuk Kepatuhan -->
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">

                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Kategori Kepatuhan</th>
                                <th>Kategori Kepatuhan</th>
                                <th>Bentuk Kepatuhan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Contoh satu baris data kategori kepatuhan -->
                            <tr>
                                <td></td>
                                <td>KK001</td>
                                <td>Sikap</td>
                                <td>
                                    <a href="/bentuk-kepatuhan" class="btn btn-primary btn-sm">Detail</a>
                                </td>

                                <!-- Aksi: dropdown menu -->
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>

                                        <!-- Menu dropdown aksi -->
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fa fa-edit me-2 text-primary"></i> Update
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="fa fa-trash me-2"></i> Delete
                                                </button>
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
