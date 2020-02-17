<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswa";

    protected $fillable = [
        'id_user',
        'NPM',
        'IPK',
        'id_jurusan',
        'id_program_studi'
    ];

    public function jurusan_sma()
    {
        return $this->belongsTo('App\Jurusan_SMA','id_jurusan','id_jurusan');
    }

    public function program_studi(){
        return $this->belongsTo('App\Program_Studi','id_program_studi','id_program_studi');
    }

    public function nilai(){
        return $this->hasMany('App\Nilai','id_user','id_user');
    }
}
