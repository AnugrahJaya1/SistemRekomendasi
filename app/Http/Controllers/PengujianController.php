<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;
use Phpml\CrossValidation\RandomSplit;

use App\Http\Controllers\PearsonCorrelationController2;

use Phpml\Dataset\ArrayDataset;

class PengujianController extends Controller
{
    public function index()
    {
        $mhs = new MahasiswaController();
        $data = $mhs->index("IPS")->toArray();

        // untuk label setiap data
        $arrLabel = array();

        // array labelnya bisa pake id_program_studi
        foreach ($data as $m) {
            array_push($arrLabel, $m["id_program_studi"]);
        }
        // array sample dan label
        $dataset = new ArrayDataset($data, $arrLabel);

        $dataset = new RandomSplit($dataset, 0.3);

        $train = $dataset->getTrainSamples();
        $test = $dataset->getTestSamples();

        // print_r($dataset->getTestSamples()[0]['nilai']);

        $x = $dataset->getTestSamples()[0]['nilai'];

        print_r($x);
        echo "<br>";
        echo "<br>";

        foreach ($x as $x) {
            // foreach($x as $x){
            print_r($x);
            echo "<br>";
            print_r($x[0]);
            echo "<br>";
            // }
        }

        echo "<br>";
        // print($dataset->getTestLabels()[0]);

        print("Jumlah Train Sample : ".count($train));
        echo"<br>";
        print("Jumlah Test Sample : ".count($test));
        // $pearonCorrelation = new PearsonCorrelationController2();

        // $covariance = $pearonCorrelation->calcula

        return view('/pengujian');
    }
}
