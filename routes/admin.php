<?php

//==============================后台

Route::group(['namespace'=>'Admin','middleware'=>['auth','admin']],function(){

    //==========================主页
    Route::get('/','AdminController@main');
    //==========================上传
//    Route::post('upload/{action}','HandlerController@upload');
    //==========================首页
    Route::get('/index','AdminController@index');

    //==========================rbac
    Route::resource('users','Rbac\UserController',['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::resource('roles','Rbac\RoleController',['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    Route::resource('permissions','Rbac\PermissionController',['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

});

//==============================后台
Route::group(['namespace'=>'Admin','middleware'=>['auth']],function(){
    //==========================获取数据列表
    Route::get('table/user/','Rbac\ListController@adminUsers');
    Route::get('table/permission/','Rbac\ListController@adminPermissions');
    Route::get('table/role/','Rbac\ListController@adminRoles');
});
