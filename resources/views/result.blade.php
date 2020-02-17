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
    </table>

    {{print_r($data)}}
    <table>
        <tr>
            <td>NPM</td>
            <td>id_Mata_Pelajaran</td>
            <td>101</td>
            <td>102</td>
            <td>111</td>
            <td>112</td>
            <td>AVG</td>
            <td>id_program_studi</td>
        </tr>

        <!-- JANGAN DIHAPUS INI KEPAKE -->
        @foreach($dataMahasiswa as $mhs)
            @foreach($mhs->nilai as $n)
            <tr>
                <td>{{$mhs->NPM}}</td>
                <td>{{$n->id_mata_pelajaran}}</td>
                <td>{{$n['101']}}</td>
                <td>{{$n['102']}}</td>
                <td>{{$n['111']}}</td>
                <td>{{$n['112']}}</td>
                <td>{{$n->AVG}}</td>
                <td>{{$mhs->id_program_studi}}</td>
            </tr>
            @endforeach
        @endforeach
    </table>
</div>
@endsection