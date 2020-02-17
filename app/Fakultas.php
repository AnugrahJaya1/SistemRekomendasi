<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table ="fakultas";

    protected $fillable=[
        'id_fakultas',
        'nama_fakultas'
    ];

    public function program_studi(){
        return $this->hasMany('App\Program_Studi','id_fakultas','id_fakultas');
    }
}
