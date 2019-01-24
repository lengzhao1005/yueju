<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
//            管理员
            [
                'name'=>'管理员列表',
                'url'=>'/admin/users',
                'method'=>'GET',
                'group'=>0,
                'description'=>'查看管理员列表的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'修改管理员视图',
                'url'=>'/admin/users/*/edit',
                'method'=>'GET',
                'group'=>0,
                'description'=>'修改管理员信息的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'修改管理员',
                'url'=>'/admin/users/*',
                'method'=>'PATCH',
                'group'=>0,
                'description'=>'修改管理员信息的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'删除管理员',
                'url'=>'/admin/users/*',
                'method'=>'DELETE',
                'group'=>0,
                'description'=>'删除管理员列表的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
//            角色
            [
                'name'=>'角色列表',
                'url'=>'/admin/roles',
                'method'=>'GET',
                'group'=>0,
                'description'=>'查看角色列表的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'修改角色视图',
                'url'=>'/admin/roles/*/edit',
                'method'=>'GET',
                'group'=>0,
                'description'=>'修改角色信息的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'修改角色',
                'url'=>'/admin/roles/*',
                'method'=>'PATCH',
                'group'=>0,
                'description'=>'修改角色信息的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'删除角色',
                'url'=>'/admin/role/*',
                'method'=>'DELETE',
                'group'=>0,
                'description'=>'删除角色的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
//            权限
            [
                'name'=>'权限列表',
                'url'=>'/admin/permissions',
                'method'=>'GET',
                'group'=>0,
                'description'=>'查看权限列表的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'修改权限视图',
                'url'=>'/admin/permissions/*/edit',
                'method'=>'GET',
                'group'=>0,
                'description'=>'修改权限信息的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'修改权限',
                'url'=>'/admin/permissions/*',
                'method'=>'PATCH',
                'group'=>0,
                'description'=>'修改权限信息的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'删除权限',
                'url'=>'/admin/permissions/*',
                'method'=>'DELETE',
                'group'=>0,
                'description'=>'删除权限的权限',
                'status'=>'T',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('permissions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->truncate();
    }
}
