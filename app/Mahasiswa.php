<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table ="mahasiswa";

    public function jurusan_sma(){
        return $this->belongsTo('App\Jurusan_SMA', 'jurusan_sma.id_jurusan');
    }
}
