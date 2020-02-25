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
            // hitung jika avg siswa belum ada
            if (!array_key_exists($mhs->id_program_studi, $this->avgSiswa)) {
                $avgSiswa += $siswa[$id_mp][4];
            }
            $counter++;
        }
        // menambahkan avg siswa ke array
        if (!array_key_exists($mhs->id_program_studi, $this->avgSiswa)) {
            $this->avgSiswa[$mhs->id_program_studi] = $avgSiswa / $counter;
            $avgSiswa=0;
        }
        //jangan masukin avg siswa ke array
        array_push($res, $temp, $avgMhs / $counter);
        $avgMhs=0;
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
            // if ($sim > 0.7) {
                // inisialisai array agar tidak null
                $res[$mhs->id_user] = array();
                array_push($res[$mhs->id_user], $sim, $id_prodi, $IPK, $avgMhs, $avgSiswa);
            // }
        }
        return $res;
    }

    public function calculatePredict($pearson)
    {
        // nilai person
        // id_user -> sim, id_prodi, IPK, avgMhs, avgSiswa 
        $res = array();
        $a = 0;
        $b = 0;
        $temp = 0;

        // rumus 
        // a = SIGMA(pearson * (IPK-$avgMhs))
        // b = SIGMA(pearson)
        // avgSiswa + a/b
        foreach ($pearson as $id_user => $value) {
            // sim * (IPK-AvgMhs)
            $a += $value[0] * ($value[2] - $value[3]);
            // sim
            $b += $value[0];

            // isi next sim, id_prodi, IPK, avgMhs, avgSiswa 
            $next = next($pearson);

            if ($next != null) {
                // program studi mhs sekarang berbeda dengan mhs selanjutnya
                if ($value[1] != $next[1]) {
                    $temp = $value[4] + ($a / $b);
                    $namaFakultas = $this->fakultas->getNamaFakultas($value[1]);
                    $namaProdi = $this->programStudi->getNamaProgramStudi($value[1]);
                    $res[$value[1]] = array();
                    // dibalik
                    array_push($res[$value[1]], $temp, $namaFakultas, $namaProdi);
                    $a = 0;
                    $b = 0;
                }
            }
            // untuk yang terakhir
            else if ($next == null) {
                $temp = $value[4] + ($a / $b);
                $namaFakultas = $this->fakultas->getNamaFakultas($value[1]);
                $namaProdi = $this->programStudi->getNamaProgramStudi($value[1]);
                $res[$value[1]] = array();
                // dibalik
                array_push($res[$value[1]], $temp, $namaFakultas, $namaProdi);
            }
        }
        // // penampung untuk nilai prediksi IPK
        $score = array_column($res, 0);
        // sort berdasarkan nilai prediksi ipk terbesar
        array_multisort($score, SORT_DESC, $res);

        return $res;
    }
}
