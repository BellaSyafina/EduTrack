<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @if (Auth::check())
        @if (Auth::user()->role === 'admin')
            <p>Admin</p>

        @elseif (Auth::user()->role === 'wali kelas')
            <p>Wali Kelas</p>

        @elseif (Auth::user()->role === 'wali murid')
            <p>Wali Murid</p>

        @else
            <p>Role tidak dikenal</p>
        @endif
    @else
        <p>Belum login</p>
    @endif

</body>
</html>
