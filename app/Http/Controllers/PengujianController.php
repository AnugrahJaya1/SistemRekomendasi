<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MahasiswaController;

class PengujianController extends Controller
{
    public function index()
    {
        $mhs = new MahasiswaController();
        $data = $mhs->index(1);

        foreach($data as $m){
            print_r($m->nilai);

            echo "<br>";
        break;
        }

        return view('/pengujian');
    }
}
