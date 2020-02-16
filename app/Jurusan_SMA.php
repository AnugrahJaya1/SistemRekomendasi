<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan_SMA extends Model
{
    protected $table ="jurusan_sma";

    public function mahasiswa(){
        return $this->hasMany('App\Mahasiswa', 'mahasiswa.id_jurusan');
    }
}
