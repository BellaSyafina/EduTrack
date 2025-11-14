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
    <div class="col-sm-4-xxl-5 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        <div class="card">
            <div class="card-header">
                <h5>Form Kelas</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" novalidate="">
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="namaKelas">Nama Kelas</label>
                        <input class="form-control" id="namaKelas" type="text" placeholder="Masukkan Nama Kelas..."
                            required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip">Please provide a valid city.</div>
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

    <div class="col-xxl-8 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
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
                            <tr>
                                <td></td>
                                <td>K001</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div> <a class="f-14 mb-0 f-w-500 c-light" href="">X - TKJ - 1</a>
                                            <p class="c-o-light">2 Siswa </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="/kelas/edit">
                                                    <i class="fa fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#exampleModal">
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
