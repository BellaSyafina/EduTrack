@extends('layout.template-admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <a href="">
                <svg class="stroke-icon">
                    <use href="{{ asset('') }}assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
            </a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="row">

        {{-- BAGIAN FOTO PROFIL --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">

                    {{-- FOTO USER --}}
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/default-user.png') }}"
                        class="rounded-circle mb-3" width="140" height="140"
                        style="object-fit: cover; border: 4px solid #e5e5e5;">

                    {{-- NAMA & ROLE --}}
                    <h4 class="fw-bold">{{ $user->name }}</h4>
                    <p class="text-muted mb-1">{{ ucfirst($user->role) }}</p>
                    <p class="text-muted">{{ $user->email }}</p>

                    <hr>

                    {{-- TOMBOL AKSI --}}
                    <a href="#" class="btn btn-primary btn-sm w-100 mb-2">
                        Edit Profil
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100">
                        Ganti Password
                    </a>
                </div>
            </div>
        </div>

        {{-- BAGIAN INFORMASI DETAIL --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="fw-bold">Informasi Akun</h5>
                </div>
                <div class="card-body">

                    <table class="table table-borderless mb-0">
                        <tr>
                            <th class="text-muted">Username</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Role</th>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Card Tambahan --}}
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="fw-bold">Informasi Tambahan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="160" class="text-muted">Dibuat Pada</th>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                        </tr>

                        <tr>
                            <th class="text-muted">Terakhir Login</th>
                            <td>{{ $user->last_login_at ? $user->last_login_at : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
