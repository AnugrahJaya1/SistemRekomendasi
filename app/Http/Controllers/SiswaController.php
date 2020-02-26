<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\PearsonCorrelationController;
use App\Http\Controllers\MahasiswaController;

class SiswaController extends Controller
{
    private $mata_pelajaran = array(
        "mtk" => 1,
        "ind" => 2,
        "ing" => 3,
        "fsk" => 4,
        "gbr" => 5,
        "pkn" => 6,
        "kma" => 7,
    );

    function index(Request $request)
    {
        // untuk penampung input dari form
        $data = $request->input();
        // untuk menampung input yang sudah diolah, agar mudah digunakan
        $siswa = $this->dataSiswa($data);

        // inisialisasi controller mahasiswa
        $mahasiswa = new MahasiswaController();
        // data mahasiswa
        $mhs = $mahasiswa->index($siswa["btn"]);

        // inisialisasi controller pearson correlation
        $pc = new PearsonCorrelationController();
        // melakukan perhitungan kemiripan
        $pearson = $pc->calculatePearson($mhs, $siswa);

        $predict = $pc->calculatePredict1($pearson);

        // return view('/result', ['data' => $siswa, 'dataMahasiswa' => $mhs, 
        // 'pearson' => $pearson, 'predict'=>$predict]);
        return view('/result', ['predict'=>$predict, 'pearson'=>$pearson, 'siswa'=>$siswa]);
    }

    private function dataSiswa($data)
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
                        // print($k." ");
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
