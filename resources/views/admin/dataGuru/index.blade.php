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
        <a href="/guru/tambah" class="btn btn-primary">Tambah Guru</a>
    </div>

    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Daftar Guru</h5>
                </div>
            </div>
            <div class="card-body px-0 pt-0 common-option">
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Guru</th>
                                <th>Nama Guru</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>G001</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <a class="f-14 mb-0 f-w-500 c-light" href="">Rafi Nur Maulana, S.Kom</a>
                                            <p class="c-o-light">2202310098</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Laki-laki</td>
                                <td>Kepala Sekolah</td>
                                <td>Jl. Merdeka No. 10, Jakarta</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light p-2 btn-sm" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="/guru/edit">
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
                                <td>G002</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <a class="f-14 mb-0 f-w-500 c-light" href="">Bella Arum Syafina, S.Kom</a>
                                            <p class="c-o-light">2202310099</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Perempuan</td>
                                <td>Sekretaris</td>
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
