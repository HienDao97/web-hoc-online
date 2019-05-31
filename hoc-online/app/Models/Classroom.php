<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ["id", "class_name", "code", "course_id", "created_at", "updated_at", "tuition", "status", "number_of_unit"];
    protected $table = "class_rooms";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theory(){
        return $this->hasMany('App\Models\Theory', 'classroom_id')->whereNull('deleted_at');
    }

    /**
     * Get all of the posts for the country.
     */
    public function exercise()
    {
        return $this->hasManyThrough('App\Models\Exercise', 'App\Models\Theory', 'classroom_id', 'theory_id', 'id');
    }
    
}
