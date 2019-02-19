@extends('layouts.admin_layout')
@section('_css')
    <style>
        .invalid-{text-align: center}
    </style>
@endsection
@section('content')

    <div class="layui-card">
        <div class="layui-card-header">添加小区</div>

        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="{{ url('/admin/plot') }}" method="post" lay-filter="component-form-group" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">小区编码：</label>
                    <div class="layui-input-block">
                        <input type="tel" name="name" lay-verify="name" autocomplete="off" placeholder="请输入小区编码" value="{{ old('name') }}" class="layui-input">
                    </div>
                </div>



                <div class="layui-form-item layui-layout-admin">
                    <div class="layui-input-block">
                        <div class="layui-footer" style="left: 0;">
                            <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">确认添加</button>
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
