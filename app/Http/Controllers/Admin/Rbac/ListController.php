<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Controller;
use App\Repositories\PermissRepository;
use Illuminate\Http\Request;

class ListController extends Controller
{
    protected $repository;

    public function __construct(PermissRepository $repository)
    {
        $this->repository = $repository;
    }

    /*
     * 获取后台管理员列表
     */
    public function adminUsers(Request $request)
    {
        $page = $request->page;
        $limit = $request->limit;
        return $this->repository->getAdminUserList($page,$limit);
    }

    /*
     * 获取所有权限列表
     */
    public function adminRoles(Request $request)
    {
        $page = $request->page;
        $limit = $request->limit;
        return $this->repository->getRoleList($page,$limit);
    }

    /*
     * 获取所有权限列表
     */
    public function adminPermissions(Request $request)
    {
        $page = $request->page;
        $limit = $request->limit;
        return $this->repository->getPermissionList($page,$limit);
    }
}
