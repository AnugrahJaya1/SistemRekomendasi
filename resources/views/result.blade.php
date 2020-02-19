@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')
<!-- bg-light untuk container -->
<br>
<br>
<div style="width: 75%; margin: auto;" class="container">
    <table align="center" class="table table-striped table-bordered">
        <tr>
            <th style=" width: 5%">No</th>
        <th>Fakultas</th>
        <th>Program Studi</th>
        <th>IPK</th>
        </tr>
        <?php
        $i = 1;
        // print_r($predict);
        foreach ($predict as $id_prodi => $value) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $value[1]. "</td>";
            echo "<td>" . $value[2] . "</td>";
            echo "<td>" . $value[0] . "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
</div>
@endsection