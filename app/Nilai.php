<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table ="nilai";

    protected $fillable =[
        'id_nilai',
        'id_mata_pelajaran',
        'id_user',
        '101',
        '102',
        '111',
        '112',
        'AVG'
    ];
}
