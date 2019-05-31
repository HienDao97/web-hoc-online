<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "admin";
    protected $fillable = ["username", "email", "password","access_token"];
}
