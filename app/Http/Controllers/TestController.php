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
        // $query = DB::table('mahasiswa')
        // ->join('jurusan_sma','mahasiswa.id_jurusan','=','jurusan_sma.id_jurusan')
        // ->select('NPM','nama_jurusan','IPK')->get();

        // $query = Mahasiswa::with('Program_Studi')->get();

        // $query = Fakultas::with('Program_studi')->get();

        $query = Mahasiswa::with('Nilai')->get();

        $p = new ProgramStudiController();
        $n = $p->getNamaProgramStudi(110);
        // $query = MataPelajaran::with('Nilai')->get();
        return view('/test',['mahasiswa'=>$query, 'n'=>$n]);
    }
}
