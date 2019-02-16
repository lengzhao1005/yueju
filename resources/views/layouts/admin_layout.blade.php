<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', '悦居') }}-@yield('title')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ asset('/layuiadmin/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('/layuiadmin/style/admin.css') }}" media="all">

    @yield('_css')
</head>
<body>

<div class="layui-fluid">
    @yield('content')
</div>


<script src="{{ asset('/layuiadmin/layui/layui.js') }}"></script>
<script>
    window.csrf_token = "{{ csrf_token() }}";
</script>
@yield('_js')

</body>
</html>

