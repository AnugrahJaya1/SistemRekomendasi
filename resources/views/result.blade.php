@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')
<!-- bg-light untuk container -->
<br>
<br>
<div style="width: 75%; margin: auto;" class="container">
    <table align="center" class="table table-striped"">
        <tr>
            <th style=" width: 5%">No</th>
        <th>Fakultas</th>
        <th>Program Studi</th>
        <th>IPK</th>
        </tr>
        <tr>
            <td>1</td>
            <td>X</td>
            <td>120</td>
            <td>{{((3.15+3.2)/2)+((0.30698006470227*(2.84-(2.85+2.8)/2))/0.30698006470227)}}</td>
        </tr>
    </table>


    <table>
        <tr>
            <td>ID_USER</td>
            <td>NPM</td>
            <td>id_Mata_Pelajaran</td>
            <td>101</td>
            <td>102</td>
            <td>111</td>
            <td>112</td>
            <td>AVG</td>
            <td>IPK</td>
            <td>id_program_studi</td>
        </tr>

        <!-- JANGAN DIHAPUS INI KEPAKE -->
        @foreach($dataMahasiswa as $mhs)
        @foreach($mhs->nilai as $n)
        <tr>
            <td>{{$mhs->id_user}}</td>
            <td>{{$mhs->NPM}}</td>
            <td>{{$n->id_mata_pelajaran}}</td>
            <td>{{$n['101']}}</td>
            <td>{{$n['102']}}</td>
            <td>{{$n['111']}}</td>
            <td>{{$n['112']}}</td>
            <td>{{$n->AVG}}</td>
            <td>{{$mhs->IPK}}</td>
            <td>{{$mhs->id_program_studi}}</td>
        </tr>
        @endforeach
        @endforeach
    </table>
    <br>
    <table>
        <tr>
            <td>id_Mata_Pelajaran</td>
            <td>101</td>
            <td>102</td>
            <td>111</td>
            <td>112</td>
            <td>AVG</td>
        </tr>
        <?php
        foreach ($data as $key => $value) {
            echo "<tr>";
            if ($key != "_token" && $key != "btn") {
                echo "<td>" . $key . "</td>";
                echo "<td>" . $value[0] . "</td>";
                echo "<td>" . $value[1] . "</td>";
                echo "<td>" . $value[2] . "</td>";
                echo "<td>" . $value[3] . "</td>";
                echo "<td>" . $value[4] . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <br>

    <table>
        <tr>
            <td>Id_User</td>
            <td>Pearson</td>
            <td>Id_Jurusan</td>
        </tr>

        @foreach($pearson as $key=>$value)
        <tr>
            <td>{{$key}}</td>
            <td>{{$value[0]}}</td>
            <td>{{$value[1]}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection