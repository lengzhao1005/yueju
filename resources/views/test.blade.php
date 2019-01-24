
@extends('layouts.base')
@section('title','test vue')

@section('css')
    <style>
        .loving div{

        }

    </style>
@endsection

@section('content')


        <div id="mumu">

            <div class="header">
                <div class="content top">
                    <img src="{{asset('/images/logo.png')}}" width="10%">
                    mumu爱心
                </div>
            </div>
            <div class="body">

                    <div class="heart">
                        <div class="loving">
                            <span v-for="i in itmes" :key="i">

                                {{--<img v-bind:src="imgSrc" @click="useHeart($event)" width="10%" alt="">--}}
                                {{--<img v-bind:src="count==5 && i==5 ?full-img:" @click="useHeart($event)" width="10%" alt="">--}}
                                {{--<img v-if="used==5 && i==8" v-bind:src="full_src" @click="useHeart($event)" width="10%" alt="">--}}
                                {{--<img v-else-if="used==6 && i==7" v-bind:srcsrc="full_src" @click="useHeart($event)" width="10%" alt="">--}}
                                {{--<img v-else v-bind:src="i<=used ? full_src : empty_src" @click="useHeart($event)" width="10%" alt="">--}}
                                {{--<img v-bind:src="count==5 && i==5 ?full-img:" @click="useHeart($event)" width="10%" alt="">--}}
                                <span v-html="getImg(i)"></span>

                                <div v-if="i==4" class="vertical-line"></div>
                                <div v-else-if="i==8" class="vertical1-line"></div>
                                <div v-else-if="i<count" class="line"></div>

                            </span>

                            <div class="tips">
                                <p>已献1个爱心</p>
                                <p>还差11个爱心即可领取奖励</p>
                            </div>
                        </div>

                        <div class="card">
                            <img src="/images/logo.png" width="20%" alt="">
                            <div class="card_msg">
                                <p class="card_title">木木木全场代金券</p>
                                <p class="card_des">献满12个爱心即可领取</p>
                            </div>
                            <button class="not_get button">领取</button>
                        </div>
                    </div>

            </div>
            <div class="foot">
                <div class="foot-border rules">
                    献爱心规则
                    <i class="icon ion-ios-arrow-right"></i>
                </div>

                <div class="records foot-border">
                    领取记录

                    <span>
                已领取10个爱心
                <i class="icon ion-ios-arrow-right"></i>
            </span>
                </div>
            </div>

        </div>

@endsection

@section('js_test')
    <script type="text/javascript">
        /*var v1 = new  Vue({
            el:'#v1',
            data:{
                classObject:{'active':true,'error':true},
                itmes:[
                    {message:'1l'},
                    {message:'lz'}
                ],
            },
            methods:{
                changeSort:function () {
                    this.itmes.sort();
                }
            },
        });

        Vue.component('todo-item',{});

        var v2 = new Vue({
            el:'#v2',
            data:{
                todos:[
                    {title:'zb1',id:1},
                    {title:'zb2',id:2},
                    {title:'zb3',id:3},
                    {title:'zb4',id:4},
                    {title:'zb5',id:5}
                ],
                newtitle:'',
                msg:''
            },
            methods:{
                addNewTodo:function(){
                    var length = this.todos.length+1;

                    this.todos.push({
                        title:this.newtitle,
                        id:length++
                    });

                    this.newtitle='';
                },
                remove:function (index) {
                    this.todos.splice(index,1);
                },
                warn: function (message, event) {
                    // 现在我们可以访问原生事件对象
                    if (event) event.preventDefault()
                    alert(message)
                }
            },
        });*/
        var vm = new Vue({
            el:'#mumu',
            mounted() {
                console.log('Component mounted.')
            },
            data(){
                return {
                    count:12,
                    empty_src:'/images/aixin1.png',
                    full_src:'/images/aixin.png',
                    used:6,
                    itmes:[0,1,2,3,7,6,5,4,8,9,10,11]
                };
            },
            computed:{
                imgSrc:function (event) {
                    console.log(event);
                    return this.full_src;
                },
            },
            methods:{
                getImg:function (i) {
                    console.log(i);
                    var src = this.full_src;
                    if(this.used==7 && i==5){
                        src = this.empty_src;
                    }else if(this.used==6 && (i==5 || i==6)){
                        src = this.empty_src;
                    }else if(this.used==5 && (i==5 || i==6 || i==7)){
                        src = this.empty_src;
                    }else if(this.used < i ){
                        src = this.empty_src;
                    }

                    if(this.used==7 && i==8) src = this.full_src;

                    return '<img src='+src+' width=10%/>'
                }
            },
        });
    </script>
@endsection