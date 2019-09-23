<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Session;

class Theory extends Model
{
    protected $fillable = ["id", "name", "content", "video_link", "classroom_id", "course_id", "created_at", "updated_at", "deleted_at"];
    protected $table = "theories";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theory_group(){
        return $this->belongsTo('Modules\Course\Entities\TheoryGroup', 'theory_group_id');
    }

    /**
     * Render html for action collumn
     *
     * @param $data
     * @return string
     */
    public static function genColumnHtml($data){
        $message = "'Bạn có muốn xoá bài học này ra khỏi danh sách'";
        $collum = "";
        if(!empty($data)){
            if(!empty($data)){
                if(Session::get('edit')) {
                    $collum .= '<a href="#" onClick="return theoryHelper.edit('. $data->id . ')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>';
                }
                if(Session::get('destroy')){
                    $collum .= '<a href="'. route('theory.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';
                }
            }
        }
        return $collum;
    }
}
