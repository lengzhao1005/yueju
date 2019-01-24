<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class=" m-b-md" id="root">
                    @{{ message ? 'ok' :'fil' }}
                </div>
                <div class="content">
                    @component('alert',['foo'=>'bar'])
                        @slot('title')
                            Forbidden
                        @endslot

                        You are not allowed to access this resource!
                    @endcomponent
                    <div class="m-b-md" id="app">

                        <example-component></example-component>
                    </div>

                    {{--example3--}}
                    <div id="v3">
                        <p>Original message: "@{{ message }}"</p>
                        <p>Computed reversed message: "@{{ reversedMessage }}"</p>
                        <p>Computed reversed message: "@{{ firstName }}"</p>
                        <p>Computed reversed message: "@{{ lastName }}"</p>
                        <p>Computed reversed message: "@{{ fullName }}"</p>
                        <div style="color:blue;">
                            @{{ fullName2 }}<br/>
                            @{{ firstName }}
                            @{{ lastName }}
                        </div>
                    </div>
                        {{--虽然计算属性在大多数情况下更合适，但有时也需要一个自定义的侦听器。
                        这就是为什么 Vue 通过 watch 选项提供了一个更通用的方法，来响应数据的变化。
                        当需要在数据变化时执行异步或开销较大的操作时，这个方式是最有用的。--}}
                        <div id="watch-example">
                            <p>
                                Ask a yes/no question:
                                <input v-model="question">
                            </p>

                            <p>@{{ answer }}</p>

                            <img v-if="image" v-bind:src="image" alt="">

                        </div>
                </div>

            </div>
        </div>

        <!-- 因为 AJAX 库和通用工具的生态已经相当丰富，Vue 核心代码没有重复 -->
        <!-- 提供这些功能以保持精简。这也可以让你自由选择自己更熟悉的工具。 -->
        <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>

        {{--<script src="https://cdn.jsdelivr.net/npm/vue@2.5.15/dist/vue.js"></script>--}}
        <!--javascript-->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script>
            Vue.config.devtools = true;
            var vm = new Vue({
                el:'#root',
                data:{
                    message:'hello world',
                },
            });

            var v3 = new   Vue({
                el:'#v3',
                data:{
                    message:'Hello world',
                    firstName: 'Foo',
                    lastName: 'Bar',
                    // fullName: 'Foo Bar',
                },
                computed:{
                    reversedMessage:function(){
                        return this.message.split('').reverse().join('');
                    },
                    fullName:function(){
                        return this.firstName + this.lastName;
                    },
                    fullName2:{
                        get:function () {
                            return this.firstName +' '+ this.lastName;
                        },
                        set:function (newValue) {
                            var names = newValue.split(' ');
                            this.firstName = names[0];
                            this.lastName = names[names.length-1];
                        }
                    }
                },
                methods:{
                    reverseMessage:function(){
                        return this.message.split('').reverse().join('');
                    },
                },
            });

            var v4 = new Vue({
                el:'#watch-example',
                data:{
                    question:'',
                    answer:'I cannot give you an answer until you ask a question!',
                    image:'',
                },
                watch:{
                    question:function(new_question,old_question){
                        this.answer = '输入中...';
                        this.getAnswer();
                    }
                },
                methods:{
                    getAnswer:_.debounce(function(){
                        if(this.question.indexOf('?') === -1){
                            this.answer = '请以？结尾';
                            return;
                        }

                        this.answer = '努力寻找答案中。。。';

                        var vm = this;

                        axios.get('https://yesno.wtf/api')
                            .then(function(response,request){
                                vm.answer = _.capitalize(response.data.answer);
                                vm.image = response.data.image;
                            })
                            .catch(function(error){
                                vm.answer = '有错误发生+'+error;
                            });
                    },
                    500
                    ),
                },
            });
        </script>

    </body>
</html>
