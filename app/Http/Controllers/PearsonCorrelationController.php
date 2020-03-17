<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PearsonCorrelationController extends Controller
{
    private $programStudi;
    private $fakultas;
    private $sdSiswa;

    function __construct()
    {
        $this->programStudi = new ProgramStudiController();
        $this->fakultas = new FakultasController();
        $this->sdSiswa = array();
    }

    // untuk menghitung kovariansi satu mahasiswa
    // dengan satu siswa
    private function calculateCovariance($mhs, $siswa)
    {
        $res = 0;
        // nilai 1 mhs
        $nilaiMhs = $mhs['nilai'];
        $nilaiSiswa = $siswa['nilai'];
        // looping sebanyak nilai
        foreach ($nilaiSiswa as $nSiswa) {
            $idMP = $nSiswa['id_mata_pelajaran'];
            foreach ($nilaiMhs as $nMhs) {
                if ($idMP == $nMhs['id_mata_pelajaran']) {
                    for ($i = 0; $i < 4; $i++) {
                        //mahasiswa * siswa
                        $res += ($nMhs[$i] - $nMhs["AVG"]) * ($nSiswa[$i] - $nSiswa["AVG"]);
                    }
                } else if ($idMP < $nMhs['id_mata_pelajaran']) {
                    break;
                }
            }
        }
        return $res;
    }

    // mengitung standar deviasi untuk satu mahasiswa
    // dan satu siswa
    private function calculateStandarDeviation($mhs, $siswa)
    {
        $res = array();

        $sdMhs = 0;
        $sdSiswa = 0;
        // nilai 1 mhs
        $nilaiMhs = $mhs['nilai'];
        $nilaiSiswa = $siswa['nilai'];
        // looping sebanyak nilai
        foreach ($nilaiSiswa as $nSiswa) {
            $idMP = $nSiswa['id_mata_pelajaran'];
            foreach ($nilaiMhs as $nMhs) {
                if ($idMP == $nMhs['id_mata_pelajaran']) {
                    for ($i = 0; $i < 4; $i++) {
                        $sdMhs += pow($nMhs[$i] - $nMhs['AVG'], 2);
                        $sdSiswa += pow($nSiswa[$i] - $nSiswa["AVG"], 2);
                    }
                } else if ($idMP < $nMhs['id_mata_pelajaran']) {
                    break;
                }
            }
        }
        array_push($res, sqrt($sdMhs), sqrt($sdSiswa));

        return $res;
    }

    // menghitung kemiripan dengan perason
    // $mahasiswa -> seluruh mahasiswa sesuai dengan jurusan SMA
    // $siswa -> 
    public function calculatePearson($mahasiswa, $siswa)
    {
        $res = array();
        foreach ($mahasiswa as $mhs) {
            $covariance = $this->calculateCovariance($mhs, $siswa);
            $sd = $this->calculateStandarDeviation($mhs, $siswa);
            $sdMhs = $sd[0]; // standar deviasi untuk mahasiswa
            $sdSiswa = $sd[1]; // standar deviasi untuk siswa

            $id_prodi = $mhs['id_program_studi'];
            $IPK = $mhs['IPK'];

            $sim = $covariance / ($sdMhs * $sdSiswa);
            // atur threshold
            if ($sim > 0) {
                // inisialisai array agar tidak null
                $res[$mhs['id_user']] = array();
                array_push($res[$mhs['id_user']], $sim, $id_prodi, $IPK);
            }
        }
        return $res;
    }

    public function calculatePredict($pearson)
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
                    $res = $this->insertData($res, $a, $b, $value[1]);

                    $a = 0;
                    $b = 0;
                }
            } else if ($next == null) {
                $res = $this->insertData($res, $a, $b, $value[1]);
            }
        }

        // // penampung untuk nilai prediksi IPK
        $score = array_column($res, 0);
        // sort berdasarkan nilai prediksi ipk terbesar
        array_multisort($score, SORT_DESC, $res);

        return $res;
    }

    // memasukkan hasil prediksi kedalam array
    private function insertData($res, $a, $b, $id_prodi)
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
