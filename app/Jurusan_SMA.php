<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan_SMA extends Model
{
    protected $table ="jurusan_sma";

    protected $fillable =[
        'id_jurusan',
        'nama_jurusan'
    ];

    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'id_jurusan');
    }
}
