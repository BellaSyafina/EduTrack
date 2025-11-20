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
        <li class="breadcrumb-item">
            <a href="/siswa">Data Siswa</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }} </li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-12 col-xxl-12 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        @if ($errors->any())
            <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                role="alert">
                <i data-feather="alert-triangle"></i>
                <p>{{ $errors->first() }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Form Siswa</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('siswa.update', $siswa->id_siswa) }}"
                    method="POST" novalidate="">
                    @csrf
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="nis">NIS</label>
                        <input class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis"
                            type="text" value="{{ $siswa->nis }}" placeholder="Masukkan NIS..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nis')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="nama_siswa">Nama Siswa</label>
                        <input class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa"
                            name="nama_siswa" type="text" value="{{ $siswa->nama_siswa }}"
                            placeholder="Masukkan Nama Siswa..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nama_siswa')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 position-relative">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror">
                            <option selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('jenis_kelamin')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 position-relative">
                        <label class="form-label" for="id_kelas">Kelas</label>
                        <select name="id_kelas" id="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror">
                            <option selected disabled>Pilih Kelas</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id_kelas }}"
                                    {{ $siswa->id_kelas == $item->id_kelas ? 'selected' : '' }}>{{ $item->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('id_kelas')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 position-relative">
                        <label class="form-label" for="status">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="Aktif" {{ 'Aktif' == $siswa->status ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ 'Nonaktif' == $siswa->status ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('status')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10"
                            class="form-control @error('alamat') is-invalid @enderror">
                            {{ $siswa->alamat }}
                        </textarea>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('alamat')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol dibuat sejajar di baris yang sama -->
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/siswa" class="btn btn-danger">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
