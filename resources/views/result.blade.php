@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')
<!-- bg-light untuk container -->
<br>
<br>

<h1 align="center">Berikut merupakan hasil perhitungan prediksi IPK </h1>
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
        foreach ($result as $id_prodi => $value) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $value[1] . "</td>";
            echo "<td>" . $value[2] . "</td>";
            echo "<td>" . number_format($value[0], 2) . "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
    <br>
    <h6>Berdasarkan hasil prediksi, maka Anda direkomendasikan untuk memilih program studi :</h6>
    <?php
    $i = 0;
    echo "<ol>";
    foreach ($result as $id_prodi => $value) {
        if ($i <= 2 && $i < sizeof($result)) {
            echo "<li>" . $value[1] . "</li>";
        }
        $i++;
    }
    echo "</ol>";
    ?>
</div>


<br>
<br>
<br>

@endsection