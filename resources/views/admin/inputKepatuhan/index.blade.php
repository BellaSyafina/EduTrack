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
    <div class=" col-sm-12 col-xxl-8 col-lg-12 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        @if ($errors->any())
            <div class="alert alert-bg-danger light alert-dismissible fade show txt-danger border-left-danger" role="alert">
                <i data-feather="alert-triangle"></i>
                <p>{{ $errors->first() }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation custom-input" action="{{ route('input-kepatuhan.store') }}"
                    method="POST" novalidate="">
                    @csrf
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="nis">NIS</label>
                        <input class="form-control" id="nis" name="nis" type="text"
                            placeholder="Masukkan NIS..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="nama_siswa">Nama Siswa</label>
                        <input class="form-control" id="nama_siswa" name="nama_siswa" type="text" readonly>
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-select" disabled>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label class="form-label" for="tanggal_waktu">Tanggal dan Waktu</label>
                        <input class="form-control" id="tanggal_waktu" name="tanggal_waktu" type="datetime-local"
                            placeholder="Masukkan Tanggal dan Waktu..." required="">
                        <div class="valid-tooltip">Looks good!</div>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="kategori">Pilihan Kategori</label>
                        <div class="mt-2 d-flex gap-2 flex-wrap">
                            @foreach ($kategori as $item)
                                <button type="button" class="btn btn-outline-success btn-sm btn-kategori"
                                    data-id="{{ $item->id_kategori_kepatuhan }}">
                                    {{ $item->nama_kategori }}
                                </button>
                            @endforeach
                            <input type="hidden" name="kategori_id" id="kategori_id">
                        </div>
                    </div>

                    <div class="col-md-12 position-relative d-none" id="wrap_bentuk">
                        <label class="form-label">Pilihan Bentuk Kepatuhan</label>
                        <select name="bentuk_kepatuhan" id="bentuk_kepatuhan" class="form-select">
                            <option value="" disabled selected>-- Pilih Bentuk Kepatuhan --</option>
                        </select>
                    </div>
                    <div class="col-md-12 position-relative">
                        <label class="form-label" for="keterangan">Bobot</label>
                        <div class="mt-2">
                            <button id="btn_bobot" class="btn btn-secondary" type="button">+0 Poin</button>
                        </div>
                    </div>

                    <!-- Tombol dibuat sejajar di baris yang sama -->
                    <div class="col-12 mt-4 d-flex gap-2">
                        <button class="btn btn-primary w-100" type="submit">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class=" col-sm-12 col-xxl-4 col-lg-12 ord-xl-5 ord-md-6 box-ord-7 box-col-4e">
        <div class="alert bg-light-success mb-0" role="alert">
            <h5 class="alert-heading pb-2 txt-success">Panduan Point</h5>
            <hr>
            @php
                $colorStyles = [
                    ['bg' => '#e8f4ff', 'text' => '#0d6efd'], // biru
                    ['bg' => '#f3e8ff', 'text' => '#6f42c1'], // ungu
                    ['bg' => '#e9f9ef', 'text' => '#198754'], // hijau
                    ['bg' => '#fff7e6', 'text' => '#fd7e14'], // orange
                    ['bg' => '#ffe7e7', 'text' => '#dc3545'], // merah
                ];
            @endphp
            @foreach ($kategori as $item)
                <h6
                    style="color: {{ $colorStyles[$loop->index % count($colorStyles)]['text'] }}; padding: 5px; border-radius: 5px;">
                    Kategori {{ $item->nama_kategori }}</h6>
                <ul>
                    @foreach ($item->kepatuhan as $kep)
                        <li style="padding: 5px; border-radius: 5px;">{{ $kep->nama_kepatuhan }}: +{{ $kep->bobot_poin }}
                            Poin</li>
                    @endforeach
                </ul>
                <br>
            @endforeach
        </div>
    </div>

    <div class="col-xxl-12 col-lg-8 ord-xl-6 ord-md-6 box-ord-6 box-col-8e">
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

        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Daftar Input Kepatuhan Siswa</h5>
                </div>
            </div>
            <div class="card-body px-0 pt-0 common-option">
                <div class="recent-table table-responsive currency-table recent-order-table custom-scrollbar">
                    <table class="table" id="main-recent-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Kepatuhan</th>
                                <th>Bobot</th>
                                <th>Tanggal & Waktu</th>
                                <th>Penanggung Jawab</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inputKepatuhan as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $no++ }}</td>
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
                                    <td>{{ $item->kepatuhan->nama_kepatuhan }}</td>
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
                                    <td>{{ $item->user->username }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light p-2 btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="{{ route('input-kepatuhan.destroy', $item->id_input_siswa) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger"
                                                            onclick="return confirm('Hapus data kepatuhan ini?')">
                                                            <i class="fa fa-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const buttons = document.querySelectorAll('.btn-kategori');
            const select = document.getElementById('bentuk_kepatuhan');
            const wrap = document.getElementById('wrap_bentuk');
            const bobotBtn = document.getElementById('btn_bobot'); // target tombol bobot
            const nisInput = document.getElementById('nis');
            const namaInput = document.getElementById('nama_siswa');
            const kelasSelect = document.getElementById('kelas');
            const dateInput = document.getElementById('tanggal_waktu');

            buttons.forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    // simpan hidden value
                    document.getElementById('kategori_id').value = id;

                    // ✅ reset semua tombol ke outline
                    buttons.forEach(b => {
                        b.classList.remove('btn-success');
                        b.classList.add('btn-outline-success');
                    });

                    // ✅ tombol yang diklik berubah jadi solid
                    this.classList.remove('btn-outline-success');
                    this.classList.add('btn-success');

                    // fetch data
                    fetch(`/get-bentuk/${id}`)
                        .then(res => res.json())
                        .then(data => {

                            // simpan data untuk digunakan saat select berubah
                            window.bentukList = data;

                            select.innerHTML =
                                '<option disabled selected>-- Pilih Bentuk Kepatuhan --</option>';

                            data.forEach(item => {
                                select.innerHTML += `
                                    <option value="${item.id_kepatuhan}">
                                        ${item.nama_kepatuhan}
                                    </option>`;
                            });

                            wrap.classList.remove('d-none');
                        });
                });
            });

            select.addEventListener('change', function() {
                const selectedId = this.value;

                // cari data bentuk yang sesuai
                const selectedItem = window.bentukList.find(item => item.id_kepatuhan == selectedId);

                if (selectedItem) {
                    bobotBtn.textContent = `+${selectedItem.bobot_poin} Poin`;
                    bobotBtn.classList.remove('btn-secondary');
                    bobotBtn.classList.add('btn-success');
                }
            });

            nisInput.addEventListener('blur', function() {
                const nis = this.value;

                if (!nis) return;

                fetch(`/get-siswa/${nis}`)
                    .then(res => res.json())
                    .then(data => {

                        if (!data.status) {
                            // reset jika NIS tidak ditemukan
                            namaInput.value = '';
                            kelasSelect.value = '';
                            return;
                        }

                        // isi otomatis
                        namaInput.value = data.nama_siswa;

                        if (data.kelas) {
                            kelasSelect.value = data.kelas;
                        }
                    });
            });

            function setDateTimeNow() {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');

                // format wajib untuk input datetime-local → YYYY-MM-DDTHH:MM
                dateInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
            }

            setDateTimeNow();
        });
    </script>
@endpush
