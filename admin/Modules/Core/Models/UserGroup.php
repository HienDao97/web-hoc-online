<?php

namespace Modules\Core\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use Cacheable;
    protected $fillable = ["user_id", "group_id"];
    protected $cacheTime = 3600;

    /**
     * The relationship
     */
    public function group()
    {
        return $this->belongsTo('Modules\Core\Models\Group', 'group_id');
    }
    public function user()
    {
        return $this->belongsTo('Modules\Core\Models\User', 'user_id');
    }
}
