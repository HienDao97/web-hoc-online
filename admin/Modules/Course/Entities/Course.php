<?php

namespace Modules\Course\Entities;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Session;

class Course extends Model
{
    use Cacheable;

    protected $cacheTime = 60;
    protected $fillable = ["id", "name", "code", "class_info", "create_at"];
    protected $table = "courses";

    /**
     * Render html for action collumn
     *
     * @param $data
     * @return string
     */
    public static function genColumnHtml($data){
        $message = "'Bạn có muốn xoá khoá học này ra khỏi danh sách'";
        $collum = "";
        if(!empty($data)){
            if(Session::get('edit')) {
                $collum .= '<a href="#" onClick="return courseHelper.edit('. $data->id . ')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>';
            }
            if(Session::get('destroy')){
                $collum .= '<a href="'. route('course.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';
            }

        }
        return $collum;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(){
        return $this->hasMany('Modules\Course\Entities\Classroom', 'course_id')->whereNull('deleted_at');
    }
}
