<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;
use Phpml\CrossValidation\RandomSplit;

use Phpml\Dataset\ArrayDataset;

class PengujianController extends Controller
{
    public function index()
    {
        $mhs = new MahasiswaController();
        $data = $mhs->index("IPS")->toArray();

        // untuk label setiap data
        $arrLabel = array();

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

        return view('/pengujian');
    }
}
