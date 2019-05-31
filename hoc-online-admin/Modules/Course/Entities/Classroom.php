<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ["id", "class_name", "code", "course_id", "created_at", "updated_at", "tuition", "status", "number_of_unit"];
    protected $table = "class_rooms";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theory(){
        return $this->hasMany('Modules\Course\Entities\Theory', 'classroom_id');
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
            $collum = '<a href="#" onClick="return classroomHelper.edit('. $data->id . ')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>
                       <a href="'. route('theory.group.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';

        }
        return $collum;
    }
}
