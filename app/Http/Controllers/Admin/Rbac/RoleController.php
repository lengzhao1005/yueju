<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Model\Role;
use App\Repositories\PermissRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $_repositroy;

    public function __construct(PermissRepository $permissRepository)
    {
        $this->_repositroy = $permissRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permiss.role_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = $this->_repositroy->getAllPermissionByGroup()->toArray();

        return view('admin.permiss.role_create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
        ],['name.unique'=>'角色名称已存在']);

        $res = $this->_repositroy->createRole($request->all());

        if($res) return redirect('/admin/roles/create')->with('status','添加成功');
        return redirect('/admin/roles/create')->with('status','添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::getRoleAndPermissByRoleId($id);
        //获取权限列表
        $permissions = $this->_repositroy->getAllPermissionByGroup();
        return view('admin.permiss.role_edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request,
            ['name' => 'required|unique:roles,name,'.$role->id,],
            ['name.unique'=>'角色名称已存在']);

        $res = $this->_repositroy->updateRole($role,$request->only(['name','description','status','permiss']));
        if($res) return redirect('admin/roles/'.$role->id.'/edit')->with('status','修改成功');

        return redirect('admin/roles/'.$role->id.'/edit')->with('status','修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $res = $role->delete();
        if($res){
            $role->Permissions()->detach();
            return response()->json(['err_code'=>200,'err_msg'=>'删除成功']);
        }

        return response()->json(['err_code'=>500,'err_msg'=>'删除失败']);
    }
}
