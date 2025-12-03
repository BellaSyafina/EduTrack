@extends('layout.template-admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="">
                <svg class="stroke-icon">
                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
            </a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            {{-- Alert Validasi --}}
            @if ($errors->any())
                <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                    role="alert">
                    <i data-feather="alert-triangle"></i>
                    <p>{{ $errors->first() }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white rounded shadow"">
                    <h5 class="fw-bold">Ganti Password</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('profile.update-password', $user->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                value="{{ old('current_password') }}" placeholder="Masukkan password lama" required>
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="new_password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                value="{{ old('new_password') }}" placeholder="Masukkan password baru" required>
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password"
                                class="form-control @error('confirm_password') is-invalid @enderror"
                                value="{{ old('confirm_password') }}" placeholder="Konfirmasi password baru" required>
                            @error('confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Perbarui Password</button>
                        <a href="/profile" class="btn btn-outline-danger w-100 mt-2">Batal</a>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
