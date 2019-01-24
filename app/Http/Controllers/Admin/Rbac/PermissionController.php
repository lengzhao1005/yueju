<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Requests\PermissionRequest;
use App\Model\Permission;
use App\Repositories\PermissRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected $permissiRepository;
    public function __construct(PermissRepository $permissRepository)
    {
        $this->permissiRepository = $permissRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permiss.permission_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grop = config('app.permiss_group');
        return view('admin.permiss.permission_create',compact('grop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->permissiRepository->createPermission($request->only(['name','url','description','method','status']));
        return redirect('admin/permissions/create')->with('status','添加成功');
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
    public function edit(Permission $permission)
    {
        return view('admin.permiss.permission_edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request,
            ['name'=>'unique:permissions,name,'.$permission->id],
            ['name'=>'权限名已被占用']);
        $data = $request->only(['name','status','url','description','method']);
        $data['status'] = $data['status']??"F";
        $permission->update($data);
        return redirect('admin/permissions/'.$permission->id.'/edit')->with('status','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $res = $permission->delete();
        if($res){
            $permission->Roles()->detach();
            return response()->json(['err_code'=>200,'err_msg'=>'删除成功']);
        }

        return response()->json(['err_code'=>500,'err_msg'=>'删除失败']);
    }
}
