<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

	protected $table='students';
    protected $fillable = [
        'name', 'email', 'password','mobile','gender','birthday','avatar',
    ];
}
