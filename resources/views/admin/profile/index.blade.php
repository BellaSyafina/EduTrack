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
    <div class="row">

        <div class="col-md-12">
            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-bg-success light alert-dismissible fade show txt-success border-left-success"
                    role="alert">
                    <i data-feather="check-square"></i>
                    <p>{{ session('success') }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Error --}}
            @if (session('error'))
                <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                    role="alert">
                    <i data-feather="alert-triangle"></i>
                    <p>{{ session('error') }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        {{-- BAGIAN FOTO PROFIL --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">

                    {{-- FOTO USER --}}
                    <img src="{{ Auth::user()->photo ? asset('photos/' . Auth::user()->photo) : asset('assets/images/default-user.png') }}"
                        class="rounded-circle mb-3" width="140" height="140"
                        style="object-fit: cover; border: 4px solid #e5e5e5;">

                    {{-- NAMA & ROLE --}}
                    <h4 class="fw-bold">{{ $user->name }}</h4>
                    <p class="text-muted mb-1">{{ ucfirst($user->role) }}</p>
                    <p class="text-muted">{{ $user->email }}</p>

                    <hr>

                    {{-- TOMBOL AKSI --}}
                    <a href="/profile/{{ Auth::user()->id }}/edit" class="btn btn-primary btn-sm w-100 mb-2">
                        Edit Profil
                    </a>
                    <a href="{{ route('profile.change-password') }}" class="btn btn-outline-secondary btn-sm w-100">
                        Ganti Password
                    </a>
                </div>
            </div>
        </div>

        {{-- BAGIAN INFORMASI DETAIL --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white rounded shadow">
                    <h5 class="fw-bold">Informasi Akun</h5>
                </div>
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        <b>Username</b>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" value="{{ Auth::user()->username }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        <b>Email</b>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" value="{{ Auth::user()->email }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        <b>Role</b>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text"
                                            value="{{ ucfirst(Auth::user()->role) }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Card Tambahan --}}
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-success text-white rounded shadow">
                    <h5 class="fw-bold">Informasi Tambahan</h5>
                </div>
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        <b>Dibuat Pada</b>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text"
                                            value="{{ Auth::user()->last_login_at ? \Carbon\Carbon::parse(Auth::user()->last_login_at)->format('d M Y') : '-' }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        <b>Terakhir Login</b>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text"
                                            value="{{ Auth::user()->last_login_at ? \Carbon\Carbon::parse(Auth::user()->last_login_at)->format('d M Y') : '-' }}"
                                            readonly>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
