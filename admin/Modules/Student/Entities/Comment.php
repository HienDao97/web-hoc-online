<?php

namespace Modules\Student\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["id", "student_id", "student_name", "content", "parent_name", "public", "created_at", "updated_at"];
    protected $table = "comments";
}
