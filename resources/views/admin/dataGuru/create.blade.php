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
            <a href="/guru">Data Guru</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-12 col-xxl-12 col-lg-4 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        <div class="card">
            <div class="card-header">
                <h5>Form Guru</h5>
            </div>

            <div class="card-body">
                <form class="row g-3 needs-validation custom-input"
                      action="{{ route('guru.store') }}" method="POST" novalidate="">
                    @csrf

                    {{-- NIP --}}
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="nip">NIP</label>
                        <input class="form-control @error('nip') is-invalid @enderror"
                               id="nip" name="nip" type="text"
                               placeholder="Masukkan NIP..."
                               value="{{ old('nip') }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Guru --}}
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="nama_guru">Nama Guru</label>
                        <input class="form-control @error('nama_guru') is-invalid @enderror"
                               id="nama_guru" name="nama_guru" type="text"
                               placeholder="Masukkan Nama Guru..."
                               value="{{ old('nama_guru') }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('nama_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jabatan --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="jabatan">Jabatan</label>
                        <input class="form-control @error('jabatan') is-invalid @enderror"
                               id="jabatan" name="jabatan" type="text"
                               placeholder="Masukkan Jabatan..."
                               value="{{ old('jabatan') }}" required>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  rows="4" placeholder="Masukkan Alamat...">{{ old('alamat') }}</textarea>
                        <div class="valid-tooltip">Looks good!</div>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 mt-3 d-flex gap-2">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                        <a href="/guru" class="btn btn-danger">Kembali</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
