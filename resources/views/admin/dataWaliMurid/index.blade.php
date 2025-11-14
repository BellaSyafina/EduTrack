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
        <a href="/wali-murid/tambah" class="btn btn-primary">Tambah Wali Murid</a>
    </div>

    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Daftar Wali Murid</h5>
                </div>
            </div>
            <div class="card-body px-0 pt-0 common-option">
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Wali Murid</th>
                                <th>Nama Wali Murid</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>WM001</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <a class="f-14 mb-0 f-w-500 c-light" href="">Rafi Nur Maulana</a>
                                            <p class="c-o-light">2202310098</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jl. Merdeka No. 10, Jakarta</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="/wali-murid/edit">
                                                    <i class="fa fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-warning" href="/wali-murid/siswa">
                                                    <i class="fa fa-edit me-2 text-warning"></i> Siswa
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
                                <td>WM002</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <a class="f-14 mb-0 f-w-500 c-light" href="">Bella Arum Syafina</a>
                                            <p class="c-o-light">2202310099</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Saroka, Saronggi</td>
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
