<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;
use Phpml\CrossValidation\RandomSplit;
use App\Http\Controllers\KMeansController;
use App\Http\Controllers\PearsonCorrelationPengujianController;


use Phpml\Dataset\ArrayDataset;

class PengujianController extends Controller
{

    protected $train, $test;
    protected $pc;
    protected $error1, $error2;
    protected $accuracy;

    function __construct(Request $request)
    {
        $id_jurusan = $request->input();

        $mhs = new MahasiswaController();
        $data = $mhs->index($id_jurusan["btn"])->toArray();

        // untuk label setiap data
        $arrLabel = array();

        // array labelnya bisa pake id_program_studi
        foreach ($data as $m) {
            array_push($arrLabel, $m["id_program_studi"]);
        }
        // array sample dan label
        $dataset = new ArrayDataset($data, $arrLabel);

        $dataset = new RandomSplit($dataset, 0.3);

        $this->train = $dataset->getTrainSamples();
        $this->test = $dataset->getTestSamples();

        $this->error1 = array();
        $this->error2 = array();

        $this->accuracy = new AccuracyController();
    }

    public function index()
    {
        $result = array();
        $this->pc = new PearsonCorrelationPengujianController();
        $kmeans = new KMeansController(2, $this->train);

        // test = siswa
        foreach ($this->test as $t) {
            // biar tidak ada duplikat
            if (!array_key_exists($t["NPM"], $result)) {
                $temp = array();

                // hitung jarak siswa dengan centroid 
                // mengembalikan siswa masuk dalam cluster mana
                $cluster = $kmeans->hitungJarakSiswa($t);

                // mengubah data mhs dari seluruh mhs
                // menjadi anggota satu cluster dengan siswa
                $dataTrain = $kmeans->getCluster($cluster);

                // $dataTrain = $this->train;

                $pearon = $this->pc->calculatePearson($dataTrain, $t);

                $predict = $this->pc->calculatePredict($pearon);

                // print_r($predict);
                if ($predict != null) {
                    // Hitung selisih untuk mean absolute error
                    $diff1 = abs($t["IPK"] - number_format($predict[0][0], 2));
                    // Memasukkan diff1 kepada arr
                    array_push($this->error1, $diff1);

                    // Hitung selisih untuk root mean square error
                    $diff2 = pow($t["IPK"] - number_format($predict[0][0], 2), 2);
                    // Memasukkan diff1 kepada arr
                    array_push($this->error2, $diff2);

                    // isinya npm, nama programstudi, IPK, Prediksi, diff
                    array_push(
                        $temp,
                        $t["NPM"],
                        $predict[0][2],
                        $t['IPK'],
                        number_format($predict[0][0], 2),
                        $diff1,
                        $diff2
                    );
                    // Memasukkan array temp pada array result
                    array_push($result, $temp);
                }
            }
        }

        $mae = $this->accuracy->calculateMAE($this->error1);
        $rmse = $this->accuracy->calculateRMSE($this->error2);
        return view('/pengujian', ['status' => TRUE, 'result' => $result, 'mae' => $mae, 'rmse' => $rmse]);
    }
}
