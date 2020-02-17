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

    public function mahasiswa(){
        return $this->belongsTo('App\Nilai','id_user','id_user');
    }

    public function mata_pelajaran(){
        return $this->belongsTo('App\Mata_Pelajaran','id_mata_pelajaran','id_mata_pelajaran');
    }
}
