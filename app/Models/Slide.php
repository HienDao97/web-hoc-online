<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ["id", "images", "created_at", "updated_at", "deleted_at"];
    protected $table = "slides";
}
