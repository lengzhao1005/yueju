<?php
/**
 * Created by PhpStorm.
 * User: zhao
 * Date: 2018/3/21
 * Time: 18:06
 */

namespace App\Repositories;


use App\Model\Permission;
use App\Model\Role;
use App\Model\User;

class PermissRepository
{
    protected $user_model;
    protected $role_model;
    protected $permission_model;

    public function __construct(User $user,Permission $permission,Role $role)
    {
        $this->user_model = $user;
        $this->role_model = $role;
        $this->permission_model = $permission;
    }

    /**
     * 获取管理员列表
     * @param $page
     * @param $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdminUserList($page,$limit)
    {
        $skip = $limit * ($page-1);
        $admin_users = $this->user_model::getUserAndRole($skip,$limit)->toArray();

        $count = $this->user_model->where('is_admin',1)->count();
        return response()->json(['code'=>0,'data'=>$admin_users,'msg'=>'','count'=>$count]);

    }

    /**
     * 获取角色列表
     * @param $page
     * @param $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoleList($page,$limit)
    {
        $skip = $limit * ($page-1);
        $roles = $this->role_model::getRolesAndPermiss($skip,$limit)->toArray();
        $count = $this->role_model->count();
        return response()->json(['code'=>0,'data'=>$roles,'msg'=>'','count'=>$count]);
    }

    /**
     * 获取权限列表
     */
    public function getPermissionList($page,$limit)
    {
        $skip = $limit * ($page-1);
        $admin_users = $this->permission_model->skip($skip)->take($limit)->get()->toArray();
        $count = $this->permission_model->count();
        return response()->json(['code'=>0,'data'=>$admin_users,'msg'=>'','count'=>$count]);
    }

    public function createUser($user_data)
    {
        $user = $this->user_model->create($user_data);
        $roles = $user_data['role']??[];
        if(!empty($roles)){
            $user->Roles()->attach($roles);
        }
        return $user;
    }

    public function updateUser($user,$data)
    {
        $roles = $data['role']??[];
        $user->update($data);
        $user->Roles()->sync($roles);
        return $user;
    }

    /**
     * @param $permission_data
     * @return mixed
     */
    public function createPermission($permission_data)
    {
        $permission_data['status'] = ($permission_data['status'] == 'on'? 'T':'F');
        return $this->permission_model->create($permission_data);
    }

    /**
     * 获取权限分组列表
     * @return mixed
     */
    public function getAllPermissionByGroup()
    {
        return $this->permission_model::getAllPermissionByGroup();
    }

    /**
     * @param $role_data
     */
    public function createRole($role_data)
    {
        $permision_ids = $role_data['permiss']??[];

        $role = Role::create($role_data);

        if(!empty($role->toArray()) && !empty($permision_ids)){
            $role->Permissions()->attach($permision_ids);
        }

        if(!empty($role->toArray())) return $role;
        return [];
    }

    public function updateRole($role,$data)
    {
        $data['status'] = ($data['status']?'T':'F');
        $data['permiss'] = ($data['permiss']??[]);

        $res = $role->update($data);
        $role->Permissions()->sync($data['permiss']);
        return $res;
    }
}