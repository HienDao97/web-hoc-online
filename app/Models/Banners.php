<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $fillable = ["id", "images", "created_at", "updated_at"];
    protected $table = "banners";
}
