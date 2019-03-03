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

    //=========================小区管理
    Route::resource('plot', 'PlotController');
    //=========================商铺管理
    Route::resource('shop', 'ShopController');
    //=========================公司管理
    Route::resource('company', 'CompanyController');
});


Route::group(['namespace'=>'Admin\Ajax', 'prefix'=>'ajax', 'middleware'=>['auth']],function(){
    //==========================获取数据列表
    Route::get('user/','RbacController@adminUsers');
    Route::get('permission/','RbacController@adminPermissions');
    Route::get('role/','RbacController@adminRoles');

    Route::get('plot/','PlotController@plotList');

    Route::get('shop/','ShopController@shopList');

    Route::get('company/', 'CompanyController@CompanyList');
});
