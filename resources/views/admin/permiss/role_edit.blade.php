@extends('layouts.admin_layout')
@section('_css')
    <style>
        .invalid-{text-align: center}
    </style>
@endsection
@section('content')

    <div class="layui-card">
        <div class="layui-card-header">
            <a href="{{ url('admin/roles') }}" class="layui-btn layui-btn-normal">角色列表</a>
        </div>

        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="{{ url('/admin/roles').'/'.$role->id }}" method="post" lay-filter="component-form-group" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $role->id }}">
                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">角色名称：</label>
                    <div class="layui-input-block">
                        <input type="tel" name="name" lay-verify="name" autocomplete="off" placeholder="请输入角色名称" value="{{ $role->name }}" class="layui-input">
                    </div>
                </div>


                <div class="layui-form-item">
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                    <label class="layui-form-label">角色描述：</label>
                    <div class="layui-input-block">
                        <input name="description" lay-verify="description" placeholder="添加用户的角色" autocomplete="off" value="{{ $role->description }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">状态：</label>
                    <div class="layui-input-block">
                        <input type="checkbox" {{ $role->status=='T'?'checked':'' }} value="T" name="status" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">赋予权限：</label>
                    <div style="padding: 2% 2%;overflow: hidden">

                        {{--权限分组列表--}}
                        @foreach($permissions as $key=>$value)
                            <div class="layui-input-inline" style="padding: 10px; margin-bottom: 10px;background-color: #F5F5F5">
                                <div style="text-align: center;color: #000;">{{ config('app.permiss_group')[$key] }}:</div>
                                <div><input type="checkbox" lay-skin="primary" lay-filter="allChoose" title="全选"></div>

                                @foreach($value as $k=>$v)
                                    <span>
                                        <input type="checkbox" {{ in_array($v->id,$role->permission_ids->toArray())?'checked':'' }} lay-skin="primary" lay-filter="oneChoose" value="{{ $v['id'] }}" name="permiss[{{ $v['id'] }}]" title="{{ $v['name'] }}">
                                    </span>
                                @endforeach
                            </div>
                        @endforeach

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

            /*监听复选框（全选）*/
            form.on('checkbox(allChoose)', function(data){
                console.log(1);
                $(data.elem).parent('div').parent('div').find('input[type=checkbox]').prop('checked',$(data.elem).prop('checked'));
                form.render('checkbox');
            });
            /*监听复选框（未全选）*/
            form.on('checkbox(oneChoose)', function(data){

                if($(data.elem)[0].checked == false){
                    $(data.elem).parent('span').parent('div').find('div').find('input[type=checkbox]').prop('checked',false);
                }else{

                    if($(data.elem).parent('span').parent('div').find('span').find('input[type=checkbox]').not("input:checked").size() <= 0){
                        //如果其它的复选框全部被勾选了，那么全选勾中
                        $(data.elem).parent('span').parent('div').find('div').find('input[type=checkbox]').prop('checked',true);
                    }else{
                        $(data.elem).parent('span').parent('div').find('div').find('input[type=checkbox]').prop('checked',false);
                    }
                }
                form.render('checkbox');
            });

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
