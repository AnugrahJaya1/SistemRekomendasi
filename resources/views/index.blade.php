@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')

<div id="accordion" class="bg-light">
    <br>
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
                            <button class="btn btn-info" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                IPA
                            </button>
                        </h5>
                    </div>
            </td>
            <td>
                <div class="card-header" id="headingTwo">
                    <h5 class="text-center">
                        <button class="btn btn-info collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            IPS
                        </button>
                    </h5>
                </div>
            </td>
        </tr>
    </table>

    <br>
    <br>

    <div class="card bg-light border-0">
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <form action="" method="POST">
                    <table align="center" class="table table-striped">
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">Mata Pelajaran</th>
                            <th colspan="2">Kelas X</th>
                            <th colspan="2">Kelas XI</th>
                        </tr>
                        <tr>
                            <th>Semester 1</th>
                            <th>Semester 2</th>
                            <th>Semester 1</th>
                            <th>Semester 2</th>
                        </tr>
                        <tr>
                            <th>Matematika</th>
                            <td>
                                <input type="number" name="mtk101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtk102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtk111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtk112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Inggris</th>
                            <td>
                                <input type="number" name="ing101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ing102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ing111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ing112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Indonesia</th>
                            <td>
                                <input type="number" name="ind101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="inds102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ind111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ind112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Fisika</th>
                            <td>
                                <input type="number" name="fsk101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="fsks102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="fsk111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="fsk112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Kimia</th>
                            <td>
                                <input type="number" name="kma101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="kma102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="kma111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="kma112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <br>
                                <div class="text-right">
                                    <input type="submit" value="Submit" name="btnIPA" class="btn bg-success">
                                </div>
                                <br>
                            </td>
                        </tr>
                    </table>
                    <form>
            </div>
        </div>
    </div>

    <div class="card bg-light border-0">
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <form method="POST">
                    <table align="center" class="table table-striped">
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">Mata Pelajaran</th>
                            <th colspan="2">Kelas X</th>
                            <th colspan="2">Kelas XI</th>
                        </tr>
                        <tr>
                            <th>Semester 1</th>
                            <th>Semester 2</th>
                            <th>Semester 1</th>
                            <th>Semester 2</th>
                        </tr>
                        <tr>
                            <th>Matematika</th>
                            <td>
                                <input type="number" name="mtk101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtk102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtk111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtk112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Inggris</th>
                            <td>
                                <input type="number" name="ing101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ing102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ing111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ing112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Indonesia</th>
                            <td>
                                <input type="number" name="ind101" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ind102" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ind111" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ind112" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <br>
                                <div class="text-right">
                                    <input type="submit" value="Submit" name="btnIPS" class="btn bg-success">
                                </div>
                                <br>
                            </td>
                        </tr>
                    </table>
                <form>
            </div>
        </div>
    </div>
</div>

@endsection