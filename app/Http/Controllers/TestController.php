<?php

namespace App\Http\Controllers;

use App\Fakultas;
use Illuminate\Http\Request;

use App\Mahasiswa;
use App\Jurusan_SMA;
use App\Nilai;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $mahasiswa = new MahasiswaController();
        // data mahasiswa
        $mhs = $mahasiswa->index("IPS")->toArray();

        $kMeans = new KMeansController(10, $mhs);

        return view('/test',['mahasiswa'=>$mhs]);
    }
}
