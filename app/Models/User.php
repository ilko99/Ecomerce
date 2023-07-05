<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo',
        'phone',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UserOnline(){
        return Cache::has('user-is-online' . $this->id);
    }

    public static function getPermissionGroup(){
        $permission_group = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_group;
    }

    public static function getpermissionByGroupName($group_name){
        $permission = DB::table('permissions')->select('name', 'id')->where('group_name', $group_name)->get();
        return $permission;
    }

    public static function roleHasPermission($role, $permissions){
        $hasPermission = true;

        foreach($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
            return $hasPermission;
        }
    }

}
