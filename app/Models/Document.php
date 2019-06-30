<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ["title", "description", "link", "course_id", "created_at", "updated_at"];
    protected $table = "documents";
}
