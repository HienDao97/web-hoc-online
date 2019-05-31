<?php

namespace Modules\Student\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $fillable = ["id", "name", "password", "gender", "birthday", "mobile", "email", "status", "avatar", "updated_at", "created_at", "deleted_at"];
    protected $table = "students";
    //public $timestamps = false;

    public static function genColumnHtml($data){
        $message = "'Bạn có muốn xoá học sinh này khỏi danh sách'";
        $collum = "";
        if(!empty($data)){
            $collum = '<a href="'.route('student.edit', $data->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>
                       <a href="'. route('student.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';

        }
        return $collum;
    }

    public function student_class(){
        $this->hasMany("Modules\Student\Entities\StudentClassroom", "student_id");
    }

    public function saveListClass($obj) {
        // Delete old records

        StudentClassroom::where('student_id', $this->id)->delete();
        // Insert new records

        StudentClassroom::insert($obj);
    }
}
