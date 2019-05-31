<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    protected $fillable = ["id", "name", "content", "video_link", "classroom_id", "created_at", "updated_at", "deleted_at"];
    protected $table = "theories";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theory_group(){
        return $this->belongsTo('Modules\Course\Entities\TheoryGroup', 'theory_group_id');
    }
}
