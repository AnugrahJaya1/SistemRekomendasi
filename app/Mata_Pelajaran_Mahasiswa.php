<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mata_Pelajaran_Mahasiswa extends Model
{
    protected $table = "mata_pelajaran_mahasiswa";

    protected $fillable = [
        'id_mata_pelajaran_mahasiswa',
        'id_user',
        'id_mata_pelajaran'
    ];
}
