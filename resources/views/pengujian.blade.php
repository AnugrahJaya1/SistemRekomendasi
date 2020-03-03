@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')
<!-- bg-light untuk container -->
<br>
<br>

<div id="accordion" class="bg-light">
    <br>
    <form action="" method="post">
        @csrf
        <table align="center">
            <tr>
                <td colspan="2">
                    <h2 class="text-center"> Jurusan Saat SMA : </h2>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="text-center">
                                <input type="submit" value="IPA" name="btn" class="btn btn-info">
                            </h5>
                        </div>
                </td>
                <td>
                    <div class="card-header" id="headingTwo">
                        <h5 class="text-center">
                            <input type="submit" value="IPS" name="btn" class="btn btn-info">
                        </h5>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

<br>
<br>

<div style="width: 75%; margin: auto;" class="container">
    <table align="center" class="table table-striped table-bordered">
        <?php
        $status ?? '';
        if ($status ?? '') {
            echo "<tr>";
            echo "<th style=width: 5%>No</th>";
            echo "<th>NPM</th>";
            echo "<th>Program Studi</th>";
            echo "<th>IPK</th>";
            echo "<th>Prediksi IPK</th>";
            echo "<th>Error MAE</th>";
            echo "<th>Error RMSE</th>";
            echo "</tr>";


            print("MEAN ABSOLUTE ERROR = " . $mae);
            echo "<br>";
            echo "<br>";

            print("ROOT MEAN SQUARE ERROR = " . $rmse);
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
        }
        ?>
    </table>
</div>
@endsection