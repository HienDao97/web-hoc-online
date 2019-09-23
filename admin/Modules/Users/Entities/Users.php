<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['id', 'phone', 'email_order', 'email', 'firstname', 'lastname', 'created_at'];
    protected $table = "users";

    /**
     * @param array $param
     * @return mixed
     */
    public static function getBaseList($param = array()){
        $query = self::select(['id', 'address', 'phone','name', 'password', 'email_order', 'email', 'firstname', 'lastname', 'created_at']);
        if(!empty($param['id'])) {
            $query = $query->where('id', $param['id']);
        }
        return $query;
    }
}
