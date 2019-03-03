@extends('layouts.admin_layout')
@section('_css')
    <style>
        .invalid-{text-align: center}
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="layui-card">
        <div class="layui-card-header">添加小区</div>

        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="{{ url('/admin/plot') }}" method="post" lay-filter="component-form-group">

                {{ csrf_field() }}

                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('code'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">编码：</label>
                    <div class="layui-input-block">
                        <input type="text" name="code" lay-verify="required" autocomplete="off" placeholder="请输入小区编码" value="{{ old('code') }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">名称：</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" placeholder="请输入小区名称" value="{{ old('name') }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">地址：</label>
                    <div class="layui-input-block">
                        <input type="text" name="address" lay-verify="required" placeholder="请输入小区地址" value="{{ old('address') }}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div>
                        @if ($errors->has('comment'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="layui-form-label">评价：</label>
                    <div class="layui-input-block">
                        <textarea name="comment" placeholder="请输入评价" class="layui-textarea">{{ old('comment') }}</textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">标签</label>
                    <div class="layui-input-block">
                        <select name="tags" class="biaoqian" style="width: 100%">
                            <option value=""></option>
                        </select>
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
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
        function formatTopic (topic) {
            return "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" +
            topic.name ? topic.name : "Laravel"   +
                "</div></div></div>";
        }
        function formatTopicSelection (topic) {
            return topic.name || topic.text;
        }

        $(".biaoqian").select2({
            tags: true,
            placeholder: '选择相关标签',
            minimumInputLength: 5,
            language: "zh-CN",
            ajax: {
                url: '/api/tags',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateResult: formatTopic,
            templateSelection: formatTopicSelection,
            escapeMarkup: function (markup) { return markup; }



            /*ajax: {
                type: 'POST',
                url: "url",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term 请求参数 ， 请求框中输入的参数
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    /!*var itemList = [];//当数据对象不是{id:0,text:'ANTS'}这种形式的时候，可以使用类似此方法创建新的数组对象
                    var arr = data.result.list
                    for(item in arr){
                        itemList.push({id: item, text: arr[item]})
                    }*!/
                    return {
                        results: data.items,//itemList
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '请选择',//默认文字提示
            language: "zh-CN",
            tags: true,//允许手动添加
            allowClear: true,//允许清空
            escapeMarkup: function (markup) {
                return markup;
            }, // 自定义格式化防止xss注入
            minimumInputLength: 5,//最少输入多少个字符后开始查询
            formatResult: function formatRepo(repo) {
                return repo.text;
            }, // 函数用来渲染结果
            formatSelection: function formatRepoSelection(repo) {
                return repo.text;
            }*/
        });// 函数用于呈现当前的选择


    </script>
@endsection
