@extends('layouts.admin_layout')

@section('content')

    <div class="layui-btn-group demoTable">
        <button class="layui-btn" data-type="getCheckData">获取选中行数据</button>
        <button class="layui-btn" data-type="getCheckLength">获取选中数目</button>
        <button class="layui-btn" data-type="isAll">验证是否全选</button>

        <a class="layui-btn layui-btn-normal" lay-href="{{ url('admin/users/create') }}">
            <i class="layui-icon"></i>
            添加新管理员
        </a>

    </div>
    
    <table class="layui-table" id="test" lay-filter="table"></table>

    <script type="text/html" id="barDemo">
        {{--<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>--}}
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>

        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
@endsection

@section('_js')
    <script>
        layui.config({
            base: '/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['table','index'], function(){
            var table = layui.table;
            var csrf_token = "{{ csrf_token() }}";
            table.render({
                elem: '#test'
                ,url:"{{ url('admin/table/user') }}"
                ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                ,cols: [[
                    {type:'checkbox', fixed: 'left'}
                    ,{field:'id', width:80, title: 'ID', sort: true}
                    ,{field:'name', width:80, title: '用户名'}
                    ,{field:'phone', width:80, title: '电话', sort: true}
                    ,{field:'email', width:80, title: '邮箱'}
                    ,{field:'roles_str', width:200, title: '角色'}
                    ,{field: 'avatar', title: '头像', width: 150,templet:'<div><img src="@{{ d.avatar}}" width=50></div>'}
                    ,{fixed: 'right', width:178, align:'center', toolbar: '#barDemo',title:'操作'}
                ]]
                ,page:true
            });

            //监听表格复选框选择
            table.on('checkbox(table)', function(obj){
                console.log(obj)
            });
            //监听工具条
            table.on('tool(table)', function(obj){
                var data = obj.data;
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    layer.confirm('真的删除行么', function(index){
                        $.ajax({
                            url:'/admin/users/'+data.id,
                            type:'DELETE',
                            dataType:'json',
                            data:{'_token':csrf_token},
                            success:function(res){
                                if(res.err_code==200){
                                    obj.del();
                                    layer.close(index);
                                    layer.msg(res.err_msg, {icon: 6});
                                }else{
                                    layer.msg(res.err_msg, {icon: 5});
                                }
                            }
                        });
                        return;
                    });
                } else if(obj.event === 'edit'){
                    // layer.alert('编辑行：<br>'+ JSON.stringify(data))
                    window.location.href = "{{ url('/admin/users') }}/"+data.id+'/edit';
                }
            });

            var $ = layui.$, active = {
                getCheckData: function(){ //获取选中数据
                    var checkStatus = table.checkStatus('test')
                        ,data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                }
                ,getCheckLength: function(){ //获取选中数目
                    var checkStatus = table.checkStatus('test')
                        ,data = checkStatus.data;
                    layer.msg('选中了：'+ data.length + ' 个');
                }
                ,isAll: function(){ //验证是否全选
                    var checkStatus = table.checkStatus('test');
                    layer.msg(checkStatus.isAll ? '全选': '未全选')
                }
            };

            $('.demoTable .layui-btn').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });
        });
    </script>
@endsection

