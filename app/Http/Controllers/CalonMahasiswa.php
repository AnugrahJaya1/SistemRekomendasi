<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalonMahasiswa extends Controller
{
    function index(Request $request)
    {
        // print_r($request->input());
        $data = $request->input();
        $dataCalonMahasiswa = $this->dataCalonMahasiswa($data);
        // ambil data nilai pelajaran
        // 
        // ambil nilai buttonyaa trs pake if
        // ambil data yang ips/ipa
        // proses

        return view('/result', ['data' => $dataCalonMahasiswa]);
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
                    // masukan data ke temp
                    array_push($temp, $value);
                    $i++;
                } else {
                    // masukan data ke temp
                    array_push($temp, $value);
                    $i++;

                    if ($i == 5) {
                        // avg nilai
                        array_push($temp, array_sum($temp) / count($temp));
                        // masukin data ke result
                        $result[$k] = $temp;
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
