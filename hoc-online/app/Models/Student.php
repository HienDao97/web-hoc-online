<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ["id", "name", "password", "gender", "birthday", "resetpassword_token", "mobile", "email", "status", "avatar", "updated_at", "created_at", "deleted_at"];
    protected $table = "students";
    //public $timestamps = false;

    public function student_class(){
        $this->hasMany("App\Models\StudentClass", "student_id");
    }
}
