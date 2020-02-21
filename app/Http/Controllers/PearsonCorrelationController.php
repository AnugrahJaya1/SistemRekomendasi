<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Nilai;
use Illuminate\Http\Request;
use Jurusan_SMA;
use Illuminate\Support\Facades\DB;




class PearsonCorrelationController extends Controller
{
    private $indexArray;
    private $programStudi;
    private $fakultas;
    private $mahasiswa;
    private $avgSiswa;

    function __construct()
    {
        $this->indexArray = array('101', '102', '111', '112');
        $this->programStudi = new ProgramStudiController();
        $this->fakultas = new FakultasController();
        $this->avgSiswa = array();
    }

    private function calculateCovariance($mhs, $siswa)
    {
        $res = array();
        $temp = 0;

        // untuk mengambil detail nilai 
        // 1 mahasiswa dengan n nilai
        $avgMhs = 0;
        $avgSiswa = 0;
        $counter = 0;
        foreach ($mhs->nilai as $n) {
            $id_mp = $n->id_mata_pelajaran;
            for ($i = 0; $i < 4; $i++) {
                //mahasiswa * siswa
                $temp += ($n[$this->indexArray[$i]] - $n->AVG) * ($siswa[$id_mp][$i] - $siswa[$id_mp][4]);
                // hitung standar deviasi bisa disini
            }
            $avgMhs += $n->AVG;
            $avgSiswa += $siswa[$id_mp][4];
            $counter++;
        }
        // menambahkan avg siswa ke array
        if(!array_key_exists($mhs->id_program_studi, $this->avgSiswa)){
            $this->avgSiswa[$mhs->id_program_studi]=$avgSiswa / $counter; 
        }
        //jangan masukin avg siswa ke array
        array_push($res, $temp, $avgMhs / $counter);
        return $res;
    }

    private function calculateStandarDeviation($mhs, $siswa)
    {
        $res = array();
        $sdMhs = 0;
        $sdSiswa = 0;
        foreach ($mhs->nilai as $n) {
            $id_mp = $n->id_mata_pelajaran;

            for ($i = 0; $i < 4; $i++) {
                $sdMhs += pow($n[$this->indexArray[$i]] - $n->AVG, 2);
                $sdSiswa += pow($siswa[$id_mp][$i] - $siswa[$id_mp][4], 2);
            }
        }
        array_push($res, sqrt($sdMhs), sqrt($sdSiswa));
        return $res;
    }

    public function calculatePearson($mahasiswa, $siswa)
    {
        $res = array();
        foreach ($mahasiswa as $mhs) {
            $temp = $this->calculateCovariance($mhs, $siswa);
            $covariance = $temp[0];
            $avgMhs = $temp[1];
            $avgSiswa = $this->avgSiswa[$mhs->id_program_studi];
            $sd = $this->calculateStandarDeviation($mhs, $siswa);
            $sdMhs = $sd[0]; // standar deviasi untuk mahasiswa
            $sdSiswa = $sd[1]; // standar deviasi untuk siswa

            $id_prodi = $mhs->id_program_studi;
            $IPK = $mhs->IPK;

            $sim = $covariance / ($sdMhs * $sdSiswa);
            // atur threshold
            if ($sim > 0) {
                // inisialisai array agar tidak null
                $res[$mhs->id_user] = array();
                array_push($res[$mhs->id_user], $sim, $id_prodi, $IPK, $avgMhs, $avgSiswa);
            }
        }
        return $res;
    }

    public function calculatePredict($pearson)
    {
        // nilai person
        // id_user -> sim, id_prodi, IPK, avgMhs, avgSiswa 
        $res = array();
        // untuk current posisi
        $curr = 0;
        $prev = 0;
        $a = 0;
        $b = 0;
        $temp = 0;

        // rumus 
        // a = SIGMA(pearson * (IPK-$avgMhs))
        // b = SIGMA(pearson)
        // avgSiswa + a/b
        foreach ($pearson as $id_user => $value) {
            // program studi
            $curr = $value[1];
            // iterasi awal
            if ($curr != $prev) {
                $a += $value[0] * ($value[2] - $value[3]);
                $b += $value[0];
            }
            // iterasi >=1
            if ($curr == $prev) {
                // perhitungan untuk 1 user
                $a += $value[0] * ($value[2] - $value[3]);
                $b += $value[0];
            } else if ($curr != $prev && $prev != 0) {
                // untuk perhitungan prediksi prodi
                $temp = $value[4] + ($a / $b);
                // inisialisasi array
                $res[$prev] = array();
                $namaFakultas = $this->fakultas->getNamaFakultas($prev);
                $namaProdi = $this->programStudi->getNamaProgramStudi($prev);
                // dibalik
                array_push($res[$prev], $temp, $namaFakultas, $namaProdi);
                // set untuk data berikutnya
                $a = $value[0] * ($value[2] - $value[3]);
                $b = $value[0];
            }
            $prev = $curr;
        }

        // untuk prodi terakhir
        $temp = $value[4] + ($a / $b);
        // inisialisasi array
        $res[$prev] = array();
        $namaFakultas = $this->fakultas->getNamaFakultas($prev);
        $namaProdi = $this->programStudi->getNamaProgramStudi($prev);
        // dibalik
        array_push($res[$prev], $temp, $namaFakultas, $namaProdi);

        // penampung untuk nilai prediksi IPK
        $score = array_column($res, 0);
        // sort berdasarkan nilai prediksi ipk terbesar
        array_multisort($score, SORT_DESC, $res);

        return $res;
    }
}
