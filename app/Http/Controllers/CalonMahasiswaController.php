<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\PearsonCorrelationController;

class CalonMahasiswaController extends Controller
{
    //bikin variable untuk nampung array
    private $mata_pelajaran = array(
        "mtk"=>1,
        "ind"=>2,
        "ing"=>3,
        "fis"=>4,
        "gbr"=>5,
        "kim"=>6,
        "pkn"=>7
    );
    function index(Request $request)
    {
        $data = $request->input();
        $dataCalonMahasiswa = $this->dataCalonMahasiswa($data);

        // $dataMahasiswa = PearsonCorrelationController::index($dataCalonMahasiswa->btn);
        $pc = new PearsonCorrelationController();
        $dataMahasiswa = $pc->index($dataCalonMahasiswa["btn"]);
        // ambil data nilai pelajaran

        // ambil nilai buttonyaa trs pake if
        // ambil data yang ips/ipa
        // proses

        return view('/result', ['data' => $dataCalonMahasiswa, 'dataMahasiswa' => $dataMahasiswa]);
        // return view('/result',compact($dataCalonMahasiswa, $dataMahasiswa));
    }

    function dataCalonMahasiswa($data)
    {
        $i = 1;
        $result = [];
        foreach ($data as $key => $value) {
            if ($key == "_token") {
                $result[$key] = $value;
            } else {
                if ($i == 1) {
                    // key untuk mata pelajaran
                    $k = substr($key, 0, 3);
                    // temporary array
                    $temp = [];
                    // masukan data (nilai) ke temp
                    array_push($temp, ((int) $value / 20) - 1);
                    $i++;
                } else {
                    // masukan data nilai ke temp
                    array_push($temp, ((int) $value / 20) - 1);
                    $i++;

                    if ($i == 5) {
                        // avg nilai
                        array_push($temp, array_sum($temp) / count($temp));
                        // masukin data ke result
                        $result[$this->mata_pelajaran[$k]] = $temp;
                        $i = 1;
                    }
                }
            }
        }

        if (!empty($data["btnIPA"])) {
            $result["btn"] = "IPA";
        } else if (!empty($data["btnIPS"])) {
            $result["btn"] = "IPS";
        }
        return $result;
    }
}
