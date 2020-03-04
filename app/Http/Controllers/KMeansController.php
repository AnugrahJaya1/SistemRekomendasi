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

        $this->calculateCentroid($this->dataMahasiswa, $this->currCentroid);
    }

    private function randomCentroid()
    {
        for ($i = 0; $i < $this->k; $i++) {
            // random sebanyak data mahasiswa
            $key = mt_rand(0, 1739);
            if (array_key_exists($key, $this->dataMahasiswa)) {
                if (!array_key_exists($key, $this->currCentroid)) {
                    print_r(count($this->dataMahasiswa[$key]['nilai']));

                    echo"<br>";
                    echo"<br>";
                    array_push($this->currCentroid, $this->dataMahasiswa[$key]);
                } else {
                    $i--;
                }
            } else {
                $i--;
            }
        }
    }

    private function calculateCentroid($mahasiswa, $centroid)
    {
        $res = array();
        $i = 0;
        foreach ($mahasiswa as $mhs) {
            // untuk nilai satu mahasiswa
            $nilaiMhs = $mhs['nilai'];
            $tempArray = array();
            foreach ($nilaiMhs as $nMhs) {
                // nilai per mata pelajaran Mahasiswa
                $arrDistance = array();
                foreach ($centroid as $cen) {
                    // nilai permata pelajaran centroid
                    $nilaiCen = $cen['nilai'];
                    $distance = 0;
                    foreach ($nilaiCen as $nCen) {
                        // melakukkan perhitungan distance
                        if ($nMhs['id_mata_pelajaran'] == $nCen['id_mata_pelajaran']) {
                            $distance += $this->euclidianceDistance($nMhs, $nCen);
                        } else if ($nMhs['id_mata_pelajaran'] < $nCen['id_mata_pelajaran']) {
                            break;
                        }
                    }
                    // ditance untuk 
                    // memasukkan distance antara data mhs dengan centroid
                    array_push($arrDistance, $distance);
                }


                // $cluester = array_keys($arrDistance, min($arrDistance))[0];
                // array_push($arrDistance, $cluester)
                if (empty($tempArray)) {
                    array_push($tempArray, $arrDistance);
                } else {
                    $tempArray[0][0] += $arrDistance[0];
                    $tempArray[0][1] += $arrDistance[1];
                }
            }

            // mendapatkan index untuk nilai minimum
            // untuk menentukan dia masuk ke cluster mana
            $cluester = array_keys($tempArray[0], min($tempArray[0]))[0];
            array_push($tempArray[0], $cluester);

            // memasukkan kedalam array hasil
            array_push($res, $tempArray[0]);
            $i++;
        }
        // foreach($res as $r){
        //     print_r($r);
        //     echo"<br>";
        //     echo"<br>";
        // }
    }

    private function euclidianceDistance($mhs, $centroid)
    {
        // asumsi itung yang beririsan aja
        $res  = 0;
        for ($i = 0; $i < 4; $i++) {
            $res = pow($mhs[$i] - $centroid[$i], 2);
        }
        $res += pow($mhs['AVG'] - $centroid['AVG'], 2);
        $res = sqrt($res);
        return $res;
    }
}
