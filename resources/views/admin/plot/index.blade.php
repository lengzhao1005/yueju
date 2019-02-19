@extends('layouts.admin_layout')

@section('content')

    <div class="layui-btn-group demoTable">
        <a class="layui-btn layui-btn-normal" lay-href="{{ url('admin/plot/create') }}">
            <i class="layui-icon"></i>
            添加小区
        </a>

    </div>

    <table class="layui-table" id="test" lay-filter="table"></table>

    <script type="text/html" id="barTpl">
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
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
        }).use(['table','index','form'], function(){
            var table = layui.table
                ,form = layui.form;
            table.render({
                elem: '#test'
                ,url:"{{ url('admin/table/plot') }}"
                ,cellMinWidth: 150 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                ,cols: [[/*
                    {type:'checkbox', fixed: 'left'}
                    ,*/{field:'id', width:80, title: 'ID', sort: true}
                    ,{field:'code', width:150, title: '编号'}
                    ,{field:'name', width:150, title: '名称'}
                    ,{field:'tag', width:120, title: '标签'}
                    ,{field:'address', width:120, title: '地址'}
                    ,{fixed: 'right', width:178, align:'center', toolbar: '#barTpl',title:'操作'}
                ]]
                ,page:true
            });


            //监听工具条
            table.on('tool(table)', function(obj){
                var data = obj.data;
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    layer.confirm('真的删除行么，对应的用户关系也会删除', function(index){

                        $.ajax({
                            url:'{{ url('admin/roles') }}'+'/'+data.id,
                            data:{'_token':window.csrf_token},
                            type:'DELETE',
                            dataType:'json',
                            success:function(res){
                                if(res.err_code==200){
                                    obj.del();
                                    layer.close(index);
                                    layer.msg(res.err_msg,{icon:'6'})
                                }else{
                                    layer.msg(res.err_msg,{icon:5});
                                }
                                return;
                            },
                        });

                    });
                } else if(obj.event === 'edit'){
                    // layer.alert('编辑行：<br>'+ JSON.stringify(data))

                    window.location.href = "{{ url('admin/roles') }}/"+data.id+'/edit'
                }
            });

        });
    </script>
@endsection

