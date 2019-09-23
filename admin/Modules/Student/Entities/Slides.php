<?php

namespace Modules\Student\Entities;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $fillable = ["id", "images", "created_at", "updated_at"];
    protected $table = "slides";
}
