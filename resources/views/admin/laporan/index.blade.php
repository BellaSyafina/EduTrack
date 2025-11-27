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
        <li class="breadcrumb-item active">Laporan</li>
    </ol>
@endsection


@section('content')
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="fw-bold">Laporan</h4>

            <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="btn btn-danger">
                <i class="fa fa-file-pdf me-1"></i> Export PDF
            </a>
        </div>

        {{-- SEARCH & FILTER --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Cari laporan...">
            </div>

            <div class="col-md-3">
                <select name="kelas" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->nama_kelas }}"
                            {{ request('kelas') == $item->nama_kelas ? 'selected' : '' }}>
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="jenis" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Jenis</option>
                    <option value="pelanggaran" {{ request('jenis') == 'pelanggaran' ? 'selected' : '' }}>Pelanggaran
                    </option>
                    <option value="kepatuhan" {{ request('jenis') == 'kepatuhan' ? 'selected' : '' }}>Kepatuhan</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100" type="submit">Filter</button>
            </div>
        </form>


        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Pelanggaran</th>
                        <th>Jenis Kepatuhan</th>
                        <th>Bobot</th>
                        <th>Tanggal</th>
                        <th>Penanggung Jawab</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- Contoh Data --}}
                    @foreach ($laporan as $item)
                        <tr>
                            <td>{{ $laporan->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <a class="f-14 mb-0 f-w-500 c-light"
                                            href="">{{ $item->siswa->nama_siswa }}</a>
                                        <p class="c-o-light">{{ $item->siswa->nis }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->siswa->kelas->nama_kelas }}</td>
                            <td>{{ $item->pelanggaran->nama_pelanggaran ?? '-' }}</td>
                            <td>{{ $item->kepatuhan->nama_kepatuhan ?? '-' }}</td>
                            <td>
                                @if ($item->bobot_poin > 0)
                                    <span class="badge bg-success">+{{ $item->bobot_poin }} poin</span>
                                @elseif ($item->bobot_poin < 0)
                                    <span class="badge bg-danger">{{ $item->bobot_poin }} poin</span>
                                @else
                                    <span class="badge bg-secondary">0 poin</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                {{ $item->user->username }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
            <div class="mt-3">
                {{ $laporan->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@endsection
