<?php

namespace Modules\Core\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use SoftDeletes, Authenticatable, CanResetPassword, Cacheable;

    protected $fillable = ["username", "email", "password","access_token", "province_id", "commune_id", "district_id", "phone"];
    protected $table = "users";
    protected $cacheTime = 3600;

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }

    /**
     * The relationship
     */
    public function user_roles()
    {
        return $this->hasMany('Modules\Core\Models\UserRole', 'user_id');
    }
    public function roles()
    {
        return $this->hasManyThrough(
            'Modules\Core\Models\Role','Modules\Core\Models\UserRole',
            'user_id', 'id'
        );
    }
    public function user_groups()
    {
        return $this->hasMany('Modules\Core\Models\UserGroup', 'user_id');
    }
    public function groups()
    {
        return $this->hasManyThrough(
            'Modules\Core\Models\Group','Modules\Core\Models\UserGroup',
            'user_id', 'id'
        );
    }

    public function getListPermissions() {
        $roleIds = $this->user_roles->pluck("role_id")->toArray();

        $userPermissions = RolePermission::whereIn("role_id", $roleIds)->groupBy("permission_id")->pluck("permission_id")->toArray();
        //dd($userPermissions);
        return $userPermissions;
    }

    public function hasPermission($controller, $action) {
        $scorePermission = Permission::getRequestPermissionScore($controller, $action);
        //dd($scorePermission);
        //\Debugbar::info($scorePermission);
        if ($scorePermission != null) {
            $userPermissions = $this->getListPermissions();
            //\Debugbar::info($userPermissions);
            return in_array($scorePermission, $userPermissions);
        }
        // No need check permission
        return true;
    }

    public function saveListRoles($roles) {
        // Delete old records
        $this->user_roles()->delete();
        // Insert new records
        $newObjs = [];
        foreach($roles as $role) {
            $obj = [
                'user_id' => $this->id,
                'role_id' => $role,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            array_push($newObjs, $obj);
        }
        UserRole::insert($newObjs);
    }

    public function saveListGroups($groups) {
        // Delete old records
        $this->user_groups()->delete();
        // Insert new records
        $newObjs = [];
        foreach($groups as $group) {
            $obj = [
                'user_id' => $this->id,
                'group_id' => $group,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            array_push($newObjs, $obj);
        }
        UserGroup::insert($newObjs);
    }

    /**
     * Get user info from accesstoken
     * @param $access_token
     * @return mixed
     */
    public static function getUserInfoFromAccessToken($access_token){
        return self::where('access_token',$access_token)->select('id')->first();
    }

    /**
     * Get avatar url
     * @param $avatar
     * @return string
     */
    public static function getAvatarUrl($avatar){
        if(empty($avatar)){
            return "";
        }
        return env('APP_URL') . "/img/user/{$avatar}";
    }
}
