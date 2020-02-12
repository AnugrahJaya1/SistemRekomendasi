<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalonMahasiswa extends Controller
{
    function index(Request $request){
        print_r($request->input());
    }
}
