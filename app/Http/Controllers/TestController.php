<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mahasiswa;
use App\Jurusan_SMA;
use DB;

class TestController extends Controller
{
    public function index()
    {
        $query = DB::table('mahasiswa')
        ->join('jurusan_sma','mahasiswa.id_jurusan','=','jurusan_sma.id_jurusan')
        ->select('NPM','nama_jurusan','IPK')->get();

        // $query = Mahasiswa::with('jurusan_sma')->get();

        return view('/test',['mahasiswa'=>$query]);
    }
}
