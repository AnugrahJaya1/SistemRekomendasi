<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";

    protected $fillable = [
        'id_user',
        'username',
        'password'
    ];
}
