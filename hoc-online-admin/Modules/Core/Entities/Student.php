<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ["id", "name", "password", "gender", "birthday", "mobile", "email", "status", "avatar", "updated_at", "created_at", "deleted_at"];
    protected $table = "students";
}
