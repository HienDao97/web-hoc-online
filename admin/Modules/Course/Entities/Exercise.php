<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Session;

class Exercise extends Model
{
    protected $fillable = ["content", "theory_id", "course_id", "classroom_id", "answer", "name", "created_at", "updated_at"];
    protected $table = "exercises";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theory(){
        return $this->belongsTo('Modules\Course\Entities\Theory', 'theory_id');
    }

    /**
     * @param $data
     * @param $type
     * @return string
     */
    public static function getDataUrl($data, $type = "")
    {
        if (!empty($data)) {
            if(!empty($type)){
                return env("APP_URL") . "/img/{$type}/{$data}";
            }
        }
        return env("APP_URL") . '/img/logo.jpeg';
    }

    /**
     * @return array
     */
    public static function listAnswer(){
        return [
            1 => "A",
            2 => "B",
            3 => "C",
            4 => "D"
        ];
    }

    /**
     * @param $data
     * @return string
     */
    public static function genColumnHtml($data){
        $message = "'Bạn có muốn xoá học sinh này khỏi danh sách'";
        $collum = "";
        if(!empty($data)){
            if(Session::get('edit')) {
                $collum .= '<a href="'.route('exercise.edit', $data->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>';
            }
            if(Session::get('destroy')){
                $collum .= '<a href="'. route('exercise.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';
            }
        }
        return $collum;
    }

}
