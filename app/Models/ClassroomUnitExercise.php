<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassroomUnitExercise extends Model
{
    protected $table = "classroom_unit_exercises";
    protected $fillable = [ "id", "student_id", "theory_id", "point"];
}
