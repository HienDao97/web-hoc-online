<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ["content", "theory_id", "answer", "name", "created_at", "updated_at"];
    protected $table = "exercises";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theory(){
        return $this->belongsTo('App\Models\Theory', 'theory_id');
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
}
