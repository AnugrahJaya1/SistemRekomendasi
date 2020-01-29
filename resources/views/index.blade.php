@extends('layout.header')

@section('title','Sistem Rekomendasi UNPAR')

@section('container')

<div id="accordion" class="bg-light">
<br>
    <table align="center">
        <tr>
            <td colspan="2">
                <h2 class="text-center"> Jurusan Saat SMA :  </h2>
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
                <form>
                    <table align="center">
                        <tr>
                            <th></th>
                            <th>Semester 1</th>
                            <th>Semester 2</th>
                            <th>Semester 3</th>
                            <th>Semester 4</th>
                        </tr>
                        <tr>
                            <th>Matematika</th>
                            <td>
                                <input type="number" name="mtks1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtks2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtks3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtks4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Fisika</th>
                            <td>
                                <input type="number" name="fsks1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="fsks2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="fsks3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="fsks4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Kimia</th>
                            <td>
                                <input type="number" name="kmas1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="kmas2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="kmas3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="kmas4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Indonesia</th>
                            <td>
                                <input type="number" name="inds1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="inds2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="inds3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="inds4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Ingris</th>
                            <td>
                                <input type="number" name="ings1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ings2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ings3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ings4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <br>
                                <div class="text-right"> 
                                    <input type="submit" value="Submit" class="btn bg-success">
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
                <form>
                    <table align="center">
                        <tr>
                            <th></th>
                            <th>Semester 1</th>
                            <th>Semester 2</th>
                            <th>Semester 3</th>
                            <th>Semester 4</th>
                        </tr>
                        <tr>
                            <th>Matematika</th>
                            <td>
                                <input type="number" name="mtks1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtks2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtks3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="mtks4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Ekonomi</th>
                            <td>
                                <input type="number" name="ekms1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ekms2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ekms3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ekms4" min="0" max="100" required><br>
                            </td>
                        </tr>

                        <tr>
                            <th>Indonesia</th>
                            <td>
                                <input type="number" name="inds1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="inds2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="inds3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="inds4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Ingris</th>
                            <td>
                                <input type="number" name="ings1" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ings2" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ings3" min="0" max="100" required><br>
                            </td>
                            <td>
                                <input type="number" name="ings4" min="0" max="100" required><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <br>
                                <div class="text-right"> 
                                    <input type="submit" value="Submit" class="btn bg-success">
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
