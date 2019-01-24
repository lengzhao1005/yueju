<?php

namespace App\Model;

use App\Repositories\PermissRepository;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name','description','status'];

    /**
     * 定义角色和权限的关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Permissions()
    {
        return $this->belongsToMany('App\Model\Permission')->withTimestamps();
    }
    /**
     * 定义角色和管理员的关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Users()
    {
        return $this->belongsToMany('App\Model\User')->withTimestamps();
    }

    public function getGroupAttribute($value)
    {
        $grop = config('app.permiss_group');

        return $grop[$value];
    }

    public static function getRoleAndPermissByRoleId($id)
    {
        $role = self::where('id',$id)->with('Permissions')->first();
        $role->permission_ids = $role->Permissions->map(function ($item){
            return $item->id;
        });
        return $role;
    }

    public static function getRolesAndPermiss($skip='',$limit='')
    {
        if($skip!=='' && $limit!==''){
            $roles = self::where('status','T')->with('Permissions')->skip($skip)->take($limit)->get();
        }else{
            $roles = self::where('status','T')->with('Permissions')->get();
        }

        return $roles->map(function($item){

            $permisss = $item->Permissions->map(function($permiss){
                return $permiss->name;
            });
            $item->permiss_str = implode(',',$permisss->toArray());
            return $item;
        });
    }

    public static function getRoles()
    {
        return self::where('status','T')->get();
    }
}
