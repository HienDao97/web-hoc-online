<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $fillable = ["id", "class_room_id", "student_id", "course_id", "status", "created_at", "updated_at"];
    protected $table = "student_classrooms";

    public function class()
    {
        return $this->belongsTo('App\Models\Classroom', 'class_room_id');
    }
}
