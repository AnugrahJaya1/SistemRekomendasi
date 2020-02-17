<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program_Studi extends Model
{
    protected $table = "program_studi";

    protected $fillable=[
        'id_program_studi',
        'nama_program_studi',
        'id_fakultas'
    ];
}
