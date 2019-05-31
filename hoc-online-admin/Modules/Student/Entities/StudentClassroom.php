<?php

namespace Modules\Student\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentClassroom extends Model
{
    protected $fillable = ["id", "class_room_id", "student_id", "course_id", "status", "created_at", "updated_at"];
    protected $table = "student_classrooms";
}
