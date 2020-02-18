<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Nilai;
use App\Program_Studi;
use Illuminate\Http\Request;
use Jurusan_SMA;
use Illuminate\Support\Facades\DB;




class PearsonCorrelationController extends Controller
{
    private $indexArray;
    private $pearsonResult;

    function __construct()
    {
        $this->indexArray = array('101', '102', '111', '112');
    }

    public function index($jurusan_sma)
    {
        $idJurusan = 1; //IPA
        if ($jurusan_sma == "IPS") {
            $idJurusan = 2;
        }

        $dataMahasiswa = $this->dataMahasiswa($idJurusan);

        return $dataMahasiswa;
    }

    private function dataMahasiswa($idJurusan)
    {
        $query = Mahasiswa::with('Nilai')->where('id_user',4)->get();
        // cuman ambil id_user, NPM, id_mata_pelajaran, nilai, avg, id_program_studi

        return $query;
    }

    private function calculateCovariance($mhs, $siswa)
    {
        $res = 0;
        // untuk mengambil detail nilai 
        foreach ($mhs->nilai as $n) {
            $id_mp = $n->id_mata_pelajaran;
            //IPS
            if ($id_mp == 1 || $id_mp == 2 || $id_mp == 3 || $id_mp == 7) {
                for ($i = 0; $i < 4; $i++) {
                    //mahasiswa * siswa
                    $res += ($n[$this->indexArray[$i]] - $n->AVG) * ($siswa[$id_mp][$i] - $siswa[$id_mp][4]);
                }
            }
        }
        return $res;
    }

    private function calculateStandarDeviation($mhs, $siswa)
    {
        $res = array();
        $sdMhs = 0;
        $sdSiswa = 0;
        foreach ($mhs->nilai as $n) {
            $id_mp = $n->id_mata_pelajaran;
            //IPS
            if ($id_mp == 1 || $id_mp == 2 || $id_mp == 3 || $id_mp == 7) {
                for ($i = 0; $i < 4; $i++) {
                    $sdMhs += pow($n[$this->indexArray[$i]] - $n->AVG, 2);
                    $sdSiswa += pow($siswa[$id_mp][$i] - $siswa[$id_mp][4], 2);
                }
            }
        }
        array_push($res, sqrt($sdMhs), sqrt($sdSiswa));
        return $res;
    }

    public function calculatePearson($mahasiswa, $siswa)
    {
        $res = array();
        foreach ($mahasiswa as $mhs) {
            $covariance = $this->calculateCovariance($mhs, $siswa);
            $sd = $this->calculateStandarDeviation($mhs, $siswa);
            $sdMhs = $sd[0]; // standar deviasi untuk mahasiswa
            $sdSiswa = $sd[1]; // standar deviasi untuk siswa

            // inisialisai array agar tidak null
            $res[$mhs->id_user]=array();
            array_push($res[$mhs->id_user], ($covariance / ($sdMhs * $sdSiswa)), $mhs->id_program_studi);
        }
        return $res;
    }

    public function calculatePredict($mahasiswa){
        $res = array();
        foreach($this->pearsonResult as $key=>$value){

        }
    }
}
