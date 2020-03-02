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
            <th>NPM</th>
            <th>Program Studi</th>
            <th>IPK</th>
            <th>Prediksi IPK</th>
            <th>Error MAE</th>
            <th>Error RMSE</th>
        </tr>
        <?php
        print("MEAN ABSOLUTE ERROR = ".$mae);
        echo "<br>";
        echo "<br>";

        print("ROOT MEAN SQUARE ERROR = ".$rmse);
        echo "<br>";
        echo "<br>";
        $i = 1;
        foreach ($result as $res) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $res[0] . "</td>";
            echo "<td>" . $res[1] . "</td>";
            echo "<td>" . $res[2] . "</td>";
            echo "<td>" . $res[3] . "</td>";
            echo "<td>" . $res[4] . "</td>";
            echo "<td>" . $res[5] . "</td>";
            echo "</tr>";
            $i++;
        }

        ?>
    </table>
</div>
@endsection