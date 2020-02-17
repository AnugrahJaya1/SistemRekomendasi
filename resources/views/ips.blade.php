@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')

<br>
<br>

<div class="card bg-light border-0">
    <form action='/result' method="post">
        @csrf
        <table align="center" class="table table-striped text-center w-75">
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
                    <input type="number" name="mtk101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="mtk102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="mtk111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="mtk112" min="0" max="100" step="any" required><br>
                </td>
            </tr>
            <tr>
                <th>Indonesia</th>
                <td>
                    <input type="number" name="ind101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="ind102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="ind111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="ind112" min="0" max="100" step="any" required><br>
                </td>
            </tr>
            <tr>
                <th>Inggris</th>
                <td>
                    <input type="number" name="ing101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="ing102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="ing111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="ing112" min="0" max="100" step="any" required><br>
                </td>
            </tr>
            <tr>
                <th>PKN</th>
                <td>
                    <input type="number" name="pkn101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="pkn102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="pkn111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="pkn112" min="0" max="100" step="any" required><br>
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

@endsection