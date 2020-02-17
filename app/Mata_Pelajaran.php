<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mata_Pelajaran extends Model
{
    protected $table = "mata_pelajaran";

    protected $fillable = [
        'id_mata_pelajaran',
        'nama_mata_pelajaran'
    ];
}
