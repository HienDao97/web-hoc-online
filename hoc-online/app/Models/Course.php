<?php

namespace App\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use Cacheable;

    protected $cacheTime = 60;
    protected $fillable = ["id", "name", "code", "class_info", "create_at"];
    protected $table = "courses";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(){
        return $this->hasMany('App\Models\Classroom', 'course_id');
    }
}
