<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title',config('app.name'))</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Styles -->

    @yield('css')

    @yield('js')
</head>
<body>
    {{--<div class="navbar navbar-laravel">
        @section('nav')
            <li>0</li>
        @show

    </div>--}}

    <div id="app">



    </div>

    @yield('content')


    <!--javascript-->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @yield('js_test')
</body>
</html>