@extends('layouts.admin_layout')
@section('_css')
    <style>
        .invalid-{text-align: center}
    </style>
@endsection
@section('content')

    <div class="layui-card">
        <div class="layui-card-header">
            <a href="{{ url('/admin/permissions') }}" class="layui-btn layui-btn-normal">返回列表</a>
        </div>

        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="{{ url('admin/permissions').'/'.$permission->id }}" method="post" lay-filter="component-form-group" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <input type="hidden" name="id" value="{{ $permission->id }}">
                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">权限名称：</label>
                    <div class="layui-input-block">
                        <input type="tel" name="name" lay-verify="name" autocomplete="off" placeholder="请输入权限名称" value="{{ $permission->name }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="invalid-">
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">url：</label>
                    <div class="layui-input-block">
                        <input type="text" name="url" autocomplete="off" value="{{ $permission->url }}" class="layui-input" placeholder="/admin/permission">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="invalid-">
                        @if ($errors->has('group'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('group') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">所属组：</label>
                    <div class="layui-input-block">

                        {{--权限组--}}
                        <select name="group" lay-verify="required">
                            <option value=""></option>
                            @foreach(config('app.permiss_group') as $k=>$v)
                                <option {{ $permission->group==$k?'selected':'' }} value="{{ $k }}">{{ $v }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                    <label class="layui-form-label">权限描述：</label>
                    <div class="layui-input-block">
                        <input name="description" lay-verify="description" placeholder="添加用户的权限" autocomplete="off" value="{{ $permission->description }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">请求方式：</label>
                    <div class="layui-input-block">

                        <input type="radio" {{ $permission->method=='GET'?'checked':'' }} lay-skin="primary" lay-filter="oneChoose" value="GET" name="method" title="GET">
                        <input type="radio" {{ $permission->method=='POST'?'checked':'' }} lay-skin="primary" lay-filter="oneChoose" value="POST" name="method" title="POST">
                        {{--<input type="radio" lay-skin="primary" lay-filter="oneChoose" value="PUT" name="method" title="PUT">--}}
                        <input type="radio" {{ $permission->method=='PATCH'?'checked':'' }} lay-skin="primary" lay-filter="oneChoose" value="PATCH" name="method" title="PATCH">
                        <input type="radio" {{ $permission->method=='DELETE'?'checked':'' }} lay-skin="primary" lay-filter="oneChoose" value="DELETE" name="method" title="DELETE">

                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">状态：</label>
                    <div class="layui-input-block">
                        <input type="checkbox" {{ $permission->status=='T'?'checked':'' }} name="status" value="T" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                    </div>
                </div>

                <div class="layui-form-item layui-layout-admin">
                    <div class="layui-input-block">
                        <div class="layui-footer" style="left: 0;">
                            <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">确认修改</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('_js')
    <script>

        layui.config({
            base: '/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'form'], function(){
            var $ = layui.$
                ,admin = layui.admin
                ,element = layui.element
                ,layer = layui.layer
                ,form = layui.form;

            form.render(null, 'component-form-group');

            /* 自定义验证规则 */
            form.verify({
                name: function(value){
                    if(value.length < 2){
                        return '名称至少得2个字符!';
                    }
                }
                ,content: function(value){
                    layedit.sync(editIndex);
                }
            });

            /* 监听指定开关 */
            //监听指定开关
            form.on('switch(switchTest)', function(data){
                layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
                    offset: '6px'
                });
                if(this.checked){
                    layer.tips('启用', data.othis)
                }else{
                    layer.tips('禁用', data.othis)
                }
            });

            /* 监听提交 */
            form.on('submit(component-form-demo1)', function(data){
                /*console.log(data);
                parent.layer.alert(JSON.stringify(data.field), {
                    title: '最终的提交信息'
                });
                return false;*/
            });

            var sumbit_status = "{{ session('status') }}";
            if(sumbit_status){
                layer.alert(sumbit_status);
            }
        });
    </script>
@endsection
