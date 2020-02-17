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
        return $this->hasMany('App\Jurusan_SMA', 'id_jurusan');
    }
}
