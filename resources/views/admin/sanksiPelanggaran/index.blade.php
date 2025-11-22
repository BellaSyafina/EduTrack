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
    {{-- Tombol Tambah --}}
    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e mb-3 d-flex justify-content-end">
        <a href="/sanksi-pelanggaran/tambah" class="btn btn-primary">Tambah Sanksi Pelanggaran</a>
    </div>

    <div class="card">
        <div class="card-header card-no-border">
            <div class="header-top">
                <h5>Daftar Sanksi Pelanggaran</h5>
            </div>
        </div>
        @php
            $colorStyles = [
                ['bg' => '#e8f4ff', 'text' => '#0d6efd'], // biru
                ['bg' => '#fff7e6', 'text' => '#fd7e14'], // orange
                ['bg' => '#ffe7e7', 'text' => '#dc3545'], // merah
                ['bg' => '#f3e8ff', 'text' => '#6f42c1'], // ungu
            ];
        @endphp

        {{-- ===== KATEGORI RINGAN ===== --}}
        @foreach ($kategori as $item)
            {{-- Alert Success Hanya Untuk Kategori Yang Baru Diproses --}}
            @if (session('success') && session('kategori_id') == $item->id_kategori_pelanggaran)
                <div class="alert alert-bg-success light alert-dismissible fade show txt-success border-left-success"
                    role="alert">
                    <i data-feather="check-square"></i>
                    <p>{{ session('success') }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Error Hanya Untuk Kategori Yang Baru Diproses --}}
            @if (session('error') && session('kategori_id') == $item->id_kategori_pelanggaran)
                <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                    role="alert">
                    <i data-feather="alert-triangle"></i>
                    <p>{{ session('error') }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header" style="background: {{ $colorStyles[$loop->index % count($colorStyles)]['bg'] }};">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="mb-0" style="color: {{ $colorStyles[$loop->index % count($colorStyles)]['text'] }};">
                            Sanksi Dan Pembinaan Pelanggaran {{ $item->nama_kategori }}
                        </h5>

                        <span class="badge text-white px-2 py-1"
                            style="background: {{ $colorStyles[$loop->index % count($colorStyles)]['text'] }}; font-size:13px;">
                            Bobot {{ $item->dari_poin }} - {{ $item->sampai_poin }} Poin
                        </span>
                    </div>
                </div>

                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Sanksi Pelanggaran</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($item->sanksi as $sanksi)
                                <tr>
                                    <td></td>
                                    <td>{{ 'SP' . str_pad($sanksi->id_sanksi, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $sanksi->nama_sanksi }}</td>
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
                                                        href="/sanksi-pelanggaran/{{ $sanksi->id_sanksi }}/edit">
                                                        <i class="fa fa-edit me-2 text-primary"></i> Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('sanksi-pelanggaran.destroy', $sanksi->id_sanksi) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus sanksi ini?');">
                                                            <i class="fa fa-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada sanksi untuk kategori ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endsection
