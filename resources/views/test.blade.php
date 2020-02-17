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
            @foreach($mhs->nilai as $n)
                <td>{{$n->AVG}}</td>
            @endforeach
        </tr>
        @endforeach


        
    </table>
</body>

</html>