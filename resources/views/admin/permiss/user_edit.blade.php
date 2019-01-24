@extends('layouts.admin_layout')
@section('_css')
    <style>
        .invalid-{text-align: center}
    </style>
@endsection
@section('content')

    <div class="layui-card">

        <div class="layui-card-header">
            <a href="{{ url('/admin/users') }}" class="layui-btn layui-btn-normal">返回列表</a>
        </div>

        <div class="layui-card-body" style="padding: 15px;">

            <form class="layui-form" action="{{ url('/admin/users').'/'.$user->id }}" method="post" lay-filter="component-form-group" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="id" value={{ $user->id }} >
                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">手机号</label>
                    <div class="layui-input-block">
                        <input type="tel" name="phone" lay-verify="phone" autocomplete="off" placeholder="请输入手机号" value="{{ $user->phone }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="invalid-">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-block">
                        <input type="text" name="email" lay-verify="email" autocomplete="off" value="{{ $user->email }}" class="layui-input" placeholder="请输入邮箱">
                    </div>
                </div>

                <div class="layui-form-item">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <label class="layui-form-label">昵称</label>
                    <div class="layui-input-block">
                        <input name="name" lay-verify="name" placeholder="请输昵称" autocomplete="off" value="{{ $user->name }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item" >
                    <label class="layui-form-label">赋予角色</label>
                    <div class="layui-input-block" style="background-color: #F5F5F5;padding: 10px">
                        <div>
                            <input type="checkbox" {{ count($user->role_ids)==count($roles)?'checked':'' }} lay-skin="primary" lay-filter="allChoose" title="全选">
                        </div>

                        @foreach($roles as $k=>$role)
                            <span>
                            <input type="checkbox" {{ in_array($role->id,$user->role_ids->toArray())?'checked':''}} lay-skin="primary" lay-filter="oneChoose" value="{{ $role->id }}" name="role[{{ $role->id }}]" title="{{ $role->name }}">
                        </span>
                        @endforeach
                    </div>
                </div>

                <div class="layui-form-item">
                    @if ($errors->has('avatar'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('avatar') }}</strong>
                        </span>
                    @endif
                    <label class="layui-form-label" style="padding: 0.4% 15px;">上传头像</label>

                    <div class="layui-input-block">
                        <input type="file" name="avatar" id="avatar">
                        <img class="layui-upload-img" id="demo1" src="{{ asset($user->avatar) }}" width="40">
                        <p id="demoText"></p>
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
        }).use(['index', 'form', 'upload'], function(){
            var $ = layui.$
                ,admin = layui.admin
                ,element = layui.element
                ,layer = layui.layer
                ,form = layui.form
                ,upload = layui.upload;

            //普通图片上传
            var uploadInst = upload.render({
                elem: '#avatar'
                ,url: '/admin/upload/avatar'
                ,data:{'csrf-token':"{{ csrf_token() }}" }
                ,accept: 'images' //普通文件
                ,exts: 'jpeg|jpg|png|gif|' //只允许上传图片文件
                ,size: 1024 //限制文件大小，单位 KB
                ,auto: false
                ,choose:function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){

                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){

                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    //如果上传失败
                    if(res.code > 0){
                        return layer.msg('上传失败');
                    }
                    //上传成功
                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    /*var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });*/
                }
            });

            form.render(null, 'component-form-group');


            /* 自定义验证规则 */
            form.verify({
                name: function(value){
                    if(value.length < 2){
                        return '名称至少得2个字符!';
                    }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,confirm_pass:function(value){
                    var passwordValue = $('input[name=password]').val();
                    if(value != passwordValue){
                        return '两次输入的密码不一致!';
                    }
                }
                ,content: function(value){
                    layedit.sync(editIndex);
                }
            });

            /*监听复选框（全选）*/
            form.on('checkbox(allChoose)', function(data){

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

            /* 监听指定开关 */
            form.on('switch(component-form-switchTest)', function(data){
                layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
                    offset: '6px'
                });
                layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
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
                layer.alert(sumbit_status, {icon: 6});
            }
        });
    </script>
@endsection