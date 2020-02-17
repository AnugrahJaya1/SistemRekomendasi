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

    public function mahasiswa(){
        return $this->hasMany('App\Mahasiswa','id_program_studi','id_program_studi');
    }

    public function fakultas(){
        return $this->belongsTo('App\Fakultas','id_fakultas','id_fakultas');
    }
}
