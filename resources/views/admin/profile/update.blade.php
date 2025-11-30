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
        <li class="breadcrumb-item">
            <a href="/profile">Profil Pengguna</a>
        </li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <form class="form theme-form" action="{{ route('profile.update', Auth::user()->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                {{-- Alert Validasi --}}
                @if ($errors->any())
                    <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger"
                        role="alert">
                        <i data-feather="alert-triangle"></i>
                        <p>{{ $errors->first() }}</p>
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

                        {{-- INPUT UPLOAD FOTO --}}
                        <div class="mb-3">
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <small class="text-muted d-block mt-1">
                                Upload foto baru (jpg, png, max 2MB)
                            </small>
                        </div>

                        {{-- NAMA & ROLE --}}
                        <h4 class="fw-bold">{{ Auth::user()->username }}</h4>
                        <p class="text-muted mb-1">{{ ucfirst(Auth::user()->role) }}</p>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>


            {{-- BAGIAN INFORMASI DETAIL --}}
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white rounded shadow">
                        <h5 class="fw-bold">Informasi Akun</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        <b>Username</b>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" value="{{ Auth::user()->username }}"
                                            name="username">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        <b>Email</b>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" value="{{ Auth::user()->email }}"
                                            name="email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-check-circle me-2"></i> Simpan Perubahan
                        </button>
                        <a href="/profile" class="btn btn-danger ms-1">
                            <i class="fa fa-times-circle me-2"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
