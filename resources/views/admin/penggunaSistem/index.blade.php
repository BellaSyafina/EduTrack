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
        <a href="#" class="btn btn-primary">Tambah Pengguna Sistem</a>
    </div>

    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Daftar Pengguna Sistem</h5>
                </div>
            </div>
            <div class="card-body px-0 pt-0 common-option">
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Pengguna Sistem</th>
                                <th>Nama Pengguna Sistem</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- Contoh data (boleh hapus kalau pakai data dari DB) --}}
                            <tr>
                                <td></td>
                                <td>U001</td>
                                <td>Admin Sistem</td>
                                <td>admin</td>
                                <td>••••••••</td>
                                <td>Administrator</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fa fa-edit me-2 text-primary"></i> Update
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
