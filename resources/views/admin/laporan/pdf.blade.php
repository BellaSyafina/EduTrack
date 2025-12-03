<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    @include('components.title')
    @include('components.style')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 4px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <h2 class="text-center mb-3">Laporan Pelanggaran & Kepatuhan</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Pelanggaran</th>
                <th>Kepatuhan</th>
                <th>Bobot</th>
                <th>Tanggal</th>
                <th>Penanggung Jawab</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->siswa->nama_siswa }}</td>
                    <td>{{ $item->siswa->kelas->nama_kelas }}</td>
                    <td>{{ $item->pelanggaran->nama_pelanggaran ?? '-' }}</td>
                    <td>{{ $item->kepatuhan->nama_kepatuhan ?? '-' }}</td>
                    <td>{{ $item->bobot_poin }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->user->username }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('components.script')
</body>

</html>
