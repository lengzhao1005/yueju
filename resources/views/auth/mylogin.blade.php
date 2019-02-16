@extends('layouts.admin_layout')

@section('title','登录')

@section('_css')
    <link rel="stylesheet" href="{{ asset('layuiadmin/style/login.css') }}">
    <style>
        .is-invalid{
            border-color: red;
        }
    </style>
@endsection

@section('content')
    <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>悦 居</h2>
        </div>
        <form class="layui-form" action="{{ url('/login') }}" method="post" lay-filter="component-form-group" enctype="multipart/form-data">
            @csrf
            <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                    <input type="text" name="email" id="LAY-user-login-username" lay-verify="required" value="{{ old('email') }}" placeholder="用户名" class="layui-input{{ $errors->has('email') ? ' is-invalid' : '' }}">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                    <input type="password" name="password" id="LAY-user-login-password" value="{{ old('password')  }}" lay-verify="required" placeholder="密码" class="layui-input{{ $errors->has('password') ? ' is-invalid' : '' }}">
                </div>
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
                            <input type="text" name="captcha" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input{{ $errors->has('captcha') ? ' is-invalid' : '' }}">
                        </div>
                        <div class="layui-col-xs5">
                            <div style="margin-left: 10px;">
                                <img src="{{ captcha_src() }}" id="LAY-user-login-vercode" class="layadmin-user-login-codeimg" onclick="this.src='{{captcha_src()}}'+Math.random()" title="点击刷新">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item" style="margin-bottom: 20px;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} lay-skin="primary" title="记住密码">
                    {{--<a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a>--}}
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 录</button>
                </div>

            </div>
        </form>
    </div>

</div>
@stop

@section('_js')
    <script>
    layui.config({
        base: '/layuiadmin/' //静态资源所在路径
    }).extend({
        index: '/lib/index' //主入口模块
    }).use(['index', 'user'], function(){
        var $ = layui.$
            ,setter = layui.setter
            ,admin = layui.admin
            ,form = layui.form;

        form.render();

        //提交
        form.on('submit(LAY-user-login-submit)', function(obj){

        });

        var errors = '{{ $errors->any() }}';
        if(errors){
            layer.msg('{{ $errors->first() }}', {
                offset: '15px'
                , anim: 6
                , icon: 5
                , time: 1500
            });
        }
    });
</script>
@stop