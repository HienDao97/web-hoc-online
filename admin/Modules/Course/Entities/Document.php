<?php
namespace Modules\Course\Entities;
use Illuminate\Database\Eloquent\Model;
use Session;
class Document extends Model
{
    protected $fillable = ["title", "description", "download_count", "link", "course_id", "created_at", "updated_at"];
    protected $table = "documents";
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
                    $collum .= '<a href="#" onClick="return documentHelper.edit('. $data->id . ')" class="btn btn-xs btn-primary"><i class="fa fa-pencil">Sửa</i></a>';
                }
                if(Session::get('destroy')){
                    $collum .= '<a href="'. route('document.delete', $data->id) .'" onclick="return confirm('.$message.')" class="btn btn-xs btn-danger"><i class="fa fa-trash">Xoá</i></a>';
                }
            }
        }
        return $collum;
    }
}