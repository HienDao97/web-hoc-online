<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Session;

class Classroom extends Model
{
    protected $fillable = ["id", "class_name", "code", "type", "sale", "course_id", "begin_date", "end_date", "created_at", "updated_at", "tuition", "status", "number_of_unit"];
    protected $table = "class_rooms";

    public const FREE_STATUS = 0;
    public const COST_STATUS = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function theory(){
        return $this->hasMany('Modules\Course\Entities\Theory', 'classroom_id')->whereNull("theories.deleted_at");
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function course(){
        return $this->belongsTo('Modules\Course\Entities\Course', 'course_id')->whereNull("theories.deleted_at");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classromm_student(){
        return $this->hasMany('Modules\Student\Entities\StudentClassroom', 'class_room_id');
    }
    /**
     * Render html for action collumn
     *
     * @param $data
     * @return string
     */
    public static function genColumnHtml($data){
        $message = "'Bạn có muốn xoá lớp học này ra khỏi danh sách'";
        $collum = "";
        if(!empty($data)){
            if(Session::get('edit')) {
                $collum .= '<a href="#" onClick="return classroomHelper.edit(' . $data->id . ')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>';
            }
            if(Session::get('destroy')){
                $collum .= '<a href="'. route('classroom.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';
            }
        }
        return $collum;
    }
}
