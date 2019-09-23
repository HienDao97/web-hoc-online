<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;

class TheoryGroup extends Model
{
    protected $fillable = ["id", "name", "description", "status", "course_id", "updated_at", "created_at"];
    protected $table = "theory_groups";

    public const NOT_PUBLIC_STATUS = 0;
    public const PUBLIC_STATUS = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){
        return $this->belongsTo('Modules\Course\Entities\Course', 'course_id');
    }

    /**
     * @return array
     */
    public static function listStatus(){
        return [
            self::PUBLIC_STATUS => "Kích hoạt",
            self::NOT_PUBLIC_STATUS => "Không kích hoạt"
        ];
    }

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
            $collum = '<a href="#" onClick="return theoryGroupHelper.edit('. $data->id . ')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>
                       <a href="'. route('theory.group.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';

        }
        return $collum;
    }
}
