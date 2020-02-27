<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PearsonCorrelationController2 extends Controller
{
    // private $indexArray;
    private $programStudi;
    private $fakultas;
    // private $avgSiswa;

    function __construct()
    {
        // $this->indexArray = array('101', '102', '111', '112');
        $this->programStudi = new ProgramStudiController();
        $this->fakultas = new FakultasController();
        // $this->avgSiswa = array();
    }

    private function calculateCovariance($mhs, $siswa)
    {
        // $res = array();

        // untuk mengambil detail nilai 
        // 1 mahasiswa dengan n nilai
        // foreach ($mhs as $m) {
        $temp = 0;
        // nilai 1 mhs
        $nilai = $mhs['nilai'];
        // looping sebanyak nilai
        foreach ($nilai as $n) {
            $id_mp = $n['id_mata_pelajaran'];
            for ($i = 0; $i < 4; $i++) {
                //mahasiswa * siswa
                $temp += ($n[$i] - $n['AVG']) * ($siswa[$id_mp][$i] - $siswa[$id_mp][4]);
                // hitung standar deviasi bisa disini
            }
        }
        // array_push($res, $temp);
        
        // }
        // return $res;
        return $temp;
    }

    private function calculateStandarDeviation($mhs, $siswa)
    {
        $res = array();

        // foreach ($mhs as $m) {
        $sdMhs = 0;
        $sdSiswa = 0;
        // nilai 1 mhs
        $nilai = $mhs['nilai'];
        // looping sebanyak nilai
        foreach ($nilai as $n) {
            $id_mp = $n['id_mata_pelajaran'];
            for ($i = 0; $i < 4; $i++) {
                $sdMhs += pow($n[$i] - $n['AVG'], 2);
                $sdSiswa += pow($siswa[$id_mp][$i] - $siswa[$id_mp][4], 2);
            }
        }
        array_push($res, sqrt($sdMhs), sqrt($sdSiswa));
        // }
        return $res;
    }

    public function calculatePearson($mahasiswa, $siswa)
    {
        $res = array();
        foreach ($mahasiswa as $mhs) {
            $covariance = $this->calculateCovariance($mhs, $siswa);
            // $covariance = $temp[0];
            $sd = $this->calculateStandarDeviation($mhs, $siswa);
            $sdMhs = $sd[0]; // standar deviasi untuk mahasiswa
            $sdSiswa = $sd[1]; // standar deviasi untuk siswa

            $id_prodi = $mhs['id_program_studi'];
            $IPK = $mhs['IPK'];

            $sim = $covariance / ($sdMhs * $sdSiswa);
            // atur threshold
            if ($sim > 0.7) {
                // inisialisai array agar tidak null
                $res[$mhs['id_user']] = array();
                array_push($res[$mhs['id_user']], $sim, $id_prodi, $IPK);
            }
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
                    $res = $this->insertData($res, $a, $b, $value[4], $value[1]);
                    $a = 0;
                    $b = 0;
                }
            }
            // untuk yang terakhir
            else if ($next == null) {
                $res = $this->insertData($res, $a, $b, $value[4], $value[1]);
            }
        }
        // // penampung untuk nilai prediksi IPK
        $score = array_column($res, 0);
        // sort berdasarkan nilai prediksi ipk terbesar
        array_multisort($score, SORT_DESC, $res);

        return $res;
    }

    private function insertData($res, $a, $b, $avgMhs, $id_prodi)
    {
        $pred = $avgMhs + ($a / $b);
        $namaFakultas = $this->fakultas->getNamaFakultas($id_prodi);
        $namaProdi = $this->programStudi->getNamaProgramStudi($id_prodi);
        $res[$id_prodi] = array();
        // dibalik
        array_push($res[$id_prodi], $pred, $namaFakultas, $namaProdi);

        return $res;
    }

    public function calculatePredict1($pearson)
    {
        $res = array();

        // a = Sigma(sim * IPK)
        $a = 0;
        // b = Sigma(sim)
        $b = 0;
        // pred = a/b
        // id_user -> sim, id_prodi, IPK, avgMhs, avgSiswa 
        foreach ($pearson as $id_user => $value) {
            $a += $value[0] * $value[2];
            $b += $value[0];

            $next = next($pearson);

            if ($next != null) {
                // program studi mhs sekarang berbeda dengan mhs selanjutnya
                if ($value[1] != $next[1]) {
                    $res = $this->insertData1($res, $a, $b, $value[1]);

                    $a = 0;
                    $b = 0;
                }
            } else if ($next == null) {
                $res = $this->insertData1($res, $a, $b, $value[1]);
            }
        }

        // // penampung untuk nilai prediksi IPK
        $score = array_column($res, 0);
        // sort berdasarkan nilai prediksi ipk terbesar
        array_multisort($score, SORT_DESC, $res);

        return $res;
    }

    private function insertData1($res, $a, $b, $id_prodi)
    {
        $pred = $a / $b;
        $namaFakultas = $this->fakultas->getNamaFakultas($id_prodi);
        $namaProdi = $this->programStudi->getNamaProgramStudi($id_prodi);
        $res[$id_prodi] = array();
        // dibalik
        array_push($res[$id_prodi], $pred, $namaFakultas, $namaProdi);

        return $res;
    }

}
