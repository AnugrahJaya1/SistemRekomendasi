<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KMeansController extends Controller
{
    protected $currCentroid, $prevCentroid;
    private $k, $dataMahasiswa;

    public function __construct($k, $dataMahasiswa)
    {
        $this->k = $k;
        $this->dataMahasiswa = $dataMahasiswa;
        $this->currCentroid = array();
        $this->prevCentroid = array();
        $this->randomCentroid();

        $status = true;
        $abc = 0;
        while ($status) {
            $distance = $this->calculateCentroid();
            $this->calculateNewCentroid($distance);
            print($abc);
            echo "<br>";
            $abc++;
            $status = $this->calculateThreshold();
        }
    }

    private function randomCentroid()
    {
        for ($i = 0; $i < $this->k; $i++) {
            // random sebanyak data mahasiswa
            $key = mt_rand(0, 1739);
            if (array_key_exists($key, $this->dataMahasiswa)) {
                if (!array_key_exists($key, $this->currCentroid)) {
                    print_r($this->dataMahasiswa[$key]);
                    echo "<br>";
                    echo "<br>";
                    array_push($this->currCentroid, $this->dataMahasiswa[$key]);
                } else {
                    $i--;
                }
            } else {
                $i--;
            }
        }

        // array_push($this->currCentroid, $this->dataMahasiswa[1]);
        // // print_r($this->dataMahasiswa[1]);
        // // echo "<br>";
        // // echo "<br>";

        // array_push($this->currCentroid, $this->dataMahasiswa[5]);
        // // print_r($this->dataMahasiswa[5]);
        // // echo "<br>";
        // // echo "<br>";
    }

    private function calculateCentroid()
    {
        $res = array();
        $i = 0;
        foreach ($this->dataMahasiswa as $mhs) {
            // untuk nilai satu mahasiswa
            $nilaiMhs = $mhs['nilai'];
            $tempArray = array();
            foreach ($nilaiMhs as $nMhs) {
                // nilai per mata pelajaran Mahasiswa
                $arrDistance = array();
                foreach ($this->currCentroid as $cen) {
                    // nilai permata pelajaran centroid
                    $nilaiCen = $cen['nilai'];
                    $distance = 0;
                    foreach ($nilaiCen as $nCen) {
                        // melakukkan perhitungan distance untuk nilai matematika dan inggris
                        // untuk mtk (1) untuk inggris (3)
                        if (
                            $nMhs['id_mata_pelajaran'] == 1 && $nCen['id_mata_pelajaran'] == 1
                            || $nMhs['id_mata_pelajaran'] == 3 && $nCen['id_mata_pelajaran'] == 3
                        ) {
                            $distance = $this->euclidianceDistance($nMhs, $nCen);
                        } else if ($nMhs['id_mata_pelajaran'] < $nCen['id_mata_pelajaran']) {
                            break;
                        }
                    }
                    // memasukkan distance antara data mhs dengan centroid
                    array_push($arrDistance, $distance);
                }
                if (empty($tempArray)) {
                    array_push($tempArray, $arrDistance);
                } else {
                    $tempArray[0][0] += $arrDistance[0];
                    $tempArray[0][0] = sqrt($tempArray[0][0]);

                    $tempArray[0][1] += $arrDistance[1];
                    $tempArray[0][1] = sqrt($tempArray[0][1]);
                }
            }
            // mendapatkan index untuk nilai minimum
            // untuk menentukan dia masuk ke cluster mana
            $cluester = array_keys($tempArray[0], min($tempArray[0]))[0];
            array_push($tempArray[0], $cluester, $mhs['id_user']);
            // mengubah key index array
            $tempArray[0]['id_user'] = $tempArray[0][$this->k+1];
            unset($tempArray[0][$this->k+1]);

            // memasukkan kedalam array hasil
            array_push($res, $tempArray[0]);
            $i++;
        }
        // isinya d ke c0, c1, ... ,cn, cluster (index = k), id_user(index = k+1);
        return $res;
    }

    // parameter berisikan array of nilai satu mata pelajaran
    private function euclidianceDistance($mhs, $centroid)
    {
        // asumsi itung yang beririsan aja
        $res  = 0;
        for ($i = 0; $i < 4; $i++) {
            $res += pow($mhs[$i] - $centroid[$i], 2);
        }
        $res += pow($mhs['AVG'] - $centroid['AVG'], 2);
        return $res;
    }

    private function calculateNewCentroid($distance)
    {

        $this->prevCentroid = $this->currCentroid;
        // untuk index cluster
        $idx = 0;
        $newArr = array();
        $count = array();
        // looping untuk tiap centroid
        foreach ($this->currCentroid  as $key => $nMhs) {
            // $newArr = array();
            $nilaiCen = $nMhs['nilai'];
            // loping untuk tiap nilai di cen
            foreach ($nilaiCen as $subKey => $nCen) {
                $counter = 0;
                // looping untuk tiap mahasiswa
                foreach ($this->dataMahasiswa as $mhs) {
                    $nilaiMhs = $mhs['nilai'];
                    //looping untuk setiap nilai
                    foreach ($nilaiMhs as $nMhs) {
                        foreach ($distance as $dist) {
                            if ($mhs['id_user'] == $dist['id_user'] && $dist[$this->k] == $key) {
                                if (
                                    $nCen['id_mata_pelajaran'] == 1 && $nMhs['id_mata_pelajaran'] == 1
                                    ||
                                    $nMhs['id_mata_pelajaran'] == 3 && $nCen['id_mata_pelajaran'] == 3
                                ) {
                                    $nCen = $this->add($nMhs, $nCen, $counter);
                                    $counter++;
                                    // print($mhs['id_user'] . " masuk pada cluster : " . $idx . " Jumlah anggota : " . $counter);
                                    // echo "<br>";
                                }
                            }
                        }
                    }
                }
                // memasukkan cCen yang sesuai dengan centroid
                array_push($newArr, $nCen);
                // break;
            }
            // memasukkan counter ke dalam array, untuk membantu proses perhitungan centroid baru
            array_push($count, $counter);
            // break;
            $idx++;
        }

        // ubah data
        $this->newCentroid($newArr, $count);
    }

    // menambahkan nilai untuk centroid baru
    private function add($nilaiMhs, $nilaiCentroid, $counter)
    {
        for ($i = 0; $i < 4; $i++) {
            if ($counter == 0) {
                $nilaiCentroid[$i] = $nilaiMhs[$i];
            } else {
                $nilaiCentroid[$i] += $nilaiMhs[$i];
            }
        }
        if ($counter == 0) {
            $nilaiCentroid['AVG'] = $nilaiMhs['AVG'];
        } else {
            $nilaiCentroid['AVG'] += $nilaiMhs['AVG'];
        }

        return $nilaiCentroid;
    }

    // menghitung avg untuk centroid baru
    private function calculateAVG($key, $subKey, $counter)
    {
        if ($counter != 0) {
            for ($i = 0; $i < 4; $i++) {
                $this->currCentroid[$key]['nilai'][$subKey][$i] = $this->currCentroid[$key]['nilai'][$subKey][$i] / $counter;
            }
            $this->currCentroid[$key]['nilai'][$subKey]['AVG'] = $this->currCentroid[$key]['nilai'][$subKey]['AVG'] / $counter;
        }
        // else{
        //     $this->randomCentroid();
        // }
    }

    // mengubah data centroid
    private function newCentroid($newArr, $count)
    {
        $i = 0;
        foreach ($this->currCentroid as $key => $value) {
            $nilaiCen = $value['nilai'];
            foreach ($nilaiCen as $subKey => $subValue) {
                foreach ($newArr as $newA) {
                    if ($subValue['id_nilai'] == $newA['id_nilai']) {
                        $this->currCentroid[$key]['nilai'][$subKey] = $newA;
                        $this->calculateAVG($key, $subKey, $count[$i]);
                    }
                }
            }
            $i++;
        }
    }

    private function calculateThreshold()
    {
        $res = false;
        foreach ($this->currCentroid as $key => $value) {
            $nilaiCen = $value['nilai'];
            foreach ($nilaiCen as $subKey => $subValue) {
                if ($this->currCentroid[$key]['nilai'][$subKey]['id_mata_pelajaran'] == $this->prevCentroid[$key]['nilai'][$subKey]['id_mata_pelajaran']) {
                    if (
                        $this->currCentroid[$key]['nilai'][$subKey][0] - $this->prevCentroid[$key]['nilai'][$subKey][0] == 0 &&
                        $this->currCentroid[$key]['nilai'][$subKey][1] - $this->prevCentroid[$key]['nilai'][$subKey][1] == 0 &&
                        $this->currCentroid[$key]['nilai'][$subKey][2] - $this->prevCentroid[$key]['nilai'][$subKey][2] == 0 &&
                        $this->currCentroid[$key]['nilai'][$subKey][3] - $this->prevCentroid[$key]['nilai'][$subKey][3] == 0 &&
                        $this->currCentroid[$key]['nilai'][$subKey]['AVG'] - $this->prevCentroid[$key]['nilai'][$subKey]['AVG'] == 0
                    ) {
                        $res = false;
                    } else {
                        $res = true;
                    }
                }
            }
        }
        return $res;
    }
}
