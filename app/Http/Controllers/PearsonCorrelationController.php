<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Nilai;
use App\Program_Studi;
use Illuminate\Http\Request;
use Jurusan_SMA;
use DB;




class PearsonCorrelationController extends Controller
{
    public function index($jurusan_sma){
        $idJurusan = 1;//IPA
        if($jurusan_sma=="IPS"){
            $idJurusan=2;
        }

        $data = $this->dataMahasiswa($idJurusan);

        return $data;
    }

    private function dataMahasiswa($idJurusan){
        $query = DB::table('mahasiswa')
        ->join('program_studi','mahasiswa.id_program_studi','=','program_studi.id_program_studi')
        ->join('nilai','mahasiswa.id_user','=','nilai.id_user')
        ->where('id_jurusan','=',$idJurusan)
        ->orderBy('program_studi.id_program_studi','asc')
        ->select('NPM','mahasiswa.id_program_studi','id_mata_pelajaran','101','102','111','112','IPK')->get();

        return $query;
    }

    private function calculateSimilarity($data){
        //tentuin berapa matkul yang diitung
        //hitung berdasarkan mata pelajaran
    }
}
