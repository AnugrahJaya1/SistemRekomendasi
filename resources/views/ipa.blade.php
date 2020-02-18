@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')

<br>
<br>

<div class="card bg-light border-0 ">
    <form action="/result" method="post">
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
                    <input type="number" name="101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="112" min="0" max="100" step="any" required><br>
                </td>
            </tr>
            <tr>
                <th>Indonesia</th>
                <td>
                    <input type="number" name="101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="112" min="0" max="100" step="any" required><br>
                </td>
            </tr>
            <tr>
                <th>Inggris</th>
                <td>
                    <input type="number" name="101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="112" min="0" max="100" step="any" required><br>
                </td>
            </tr>
            <tr>
                <th>Fisika</th>
                <td>
                    <input type="number" name="fsk101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="fsk102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="fsk111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="fsk112" min="0" max="100" step="any" required><br>
                </td>
            </tr>
            <tr>
                <th>Kimia</th>
                <td>
                    <input type="number" name="kma101" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="kma102" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="kma111" min="0" max="100" step="any" required><br>
                </td>
                <td>
                    <input type="number" name="kma112" min="0" max="100" step="any" required><br>
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

@endsection