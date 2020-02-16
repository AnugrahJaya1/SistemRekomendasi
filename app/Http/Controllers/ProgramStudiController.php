<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Program_Studi;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $program_studi = Program_Studi::all();

        return $program_studi;
        // return view::make('/result')->with($program_studi);
        // return view('/result', ['program_studi' => $program_studi]);
    }
}
