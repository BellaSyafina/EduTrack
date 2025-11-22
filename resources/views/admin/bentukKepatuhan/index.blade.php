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
        <a href="/bentuk-kepatuhan/tambah" class="btn btn-primary">Tambah Bentuk Kepatuhan</a>
    </div>

    <div class="card">
        <div class="card-header card-no-border">
            <div class="header-top">
                <h5>Daftar Bentuk Kepatuhan</h5>
            </div>
        </div>

        @php
            $colorStyles = [
                ['bg' => '#e8f4ff', 'text' => '#0d6efd'], // biru
                ['bg' => '#e9f9ef', 'text' => '#198754'], // hijau
                ['bg' => '#fff7e6', 'text' => '#fd7e14'], // orange
                ['bg' => '#ffe7e7', 'text' => '#dc3545'], // merah
                ['bg' => '#f3e8ff', 'text' => '#6f42c1'], // ungu
            ];
        @endphp

        {{-- ===== KATEGORI SIKAP ===== --}}
        @foreach ($kategori as $item)
            {{-- Alert Success Hanya Untuk Kategori Yang Baru Diproses --}}
            @if (session('success') && session('kategori_id') == $item->id_kategori_kepatuhan)
                <div class="alert alert-bg-success light alert-dismissible fade show txt-success border-left-success"
                    role="alert">
                    <i data-feather="check-square"></i>
                    <p>{{ session('success') }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Error Hanya Untuk Kategori Yang Baru Diproses --}}
            @if (session('error') && session('kategori_id') == $item->id_kategori_kepatuhan)
                <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                    role="alert">
                    <i data-feather="alert-triangle"></i>
                    <p>{{ session('error') }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header" style="background:{{ $colorStyles[$loop->index % count($colorStyles)]['bg'] }};">
                    <h5 class="mb-0" style="color: {{ $colorStyles[$loop->index % count($colorStyles)]['text'] }};">
                        Kategori {{ $item->nama_kategori }}</h5>
                </div>


                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Kepatuhan</th>
                                <th>Nama Kepatuhan</th>
                                <th>Bobot Poin</th>
                                <th>Penghargaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($item->kepatuhan as $kepatuhan)
                                <tr>
                                    <td></td>
                                    <td>{{ 'BK' . str_pad($kepatuhan->id_kepatuhan, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $kepatuhan->nama_kepatuhan }}</td>
                                    <td>
                                        @if ($kepatuhan->bobot_poin > 0)
                                            <span class="badge bg-success">+{{ $kepatuhan->bobot_poin }} poin</span>
                                        @elseif ($kepatuhan->bobot_poin < 0)
                                            <span class="badge bg-danger">{{ $kepatuhan->bobot_poin }} poin</span>
                                        @else
                                            <span class="badge bg-secondary">0 poin</span>
                                        @endif
                                    </td>
                                    <td>{{ $kepatuhan->penghargaan ?? '-' }}</td>
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
                                                        href="/bentuk-kepatuhan/{{ $kepatuhan->id_kepatuhan }}/edit">
                                                        <i class="fa fa-edit me-2 text-primary"></i> Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('bentuk-kepatuhan.destroy', $kepatuhan->id_kepatuhan) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger"
                                                            onclick="return confirm('Hapus bentuk kepatuhan ini?')">
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
                                    <td colspan="6" class="text-center">Tidak ada data bentuk kepatuhan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endsection
