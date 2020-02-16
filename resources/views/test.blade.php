<html>

<head>
</head>

<body>
    <table>
        <tr>
            <td>NPM</td>
            <td>Jurusan SMA</td>
            <td>IPK</td>
        </tr>
        @foreach($mahasiswa as $mhs)
        <tr>
            <td>{{$mhs->NPM}}</td>
            <td>{{$mhs->nama_jurusan}}</td>
            <td>{{$mhs->IPK}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>