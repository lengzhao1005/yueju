<!-- 侧边菜单 -->
<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" lay-href="home/console.html">
            <span>layuiAdmin</span>
        </div>

        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            {{--主页--}}
            <li data-name="home" class="layui-nav-item">
                <a href="javascript:;" lay-tips="主页" lay-direction="2">
                    <i class="layui-icon layui-icon-home"></i>
                    <cite>主页</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console" class="layui-this">
                        <a lay-href="home/console.html">控制台</a>
                    </dd>
                </dl>
            </li>
            {{--用户--}}
            <li data-name="user" class="layui-nav-item">
                <a href="javascript:;" lay-tips="用户" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>用户</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="javascript:;" onclick="layer.tips('即将开放', this);">网站用户</a>
                    </dd>
                    <dd>
                        <a lay-href="{{ url('admin/users') }}">后台管理员</a>
                    </dd>
                    <dd>
                        <a lay-href="{{ url('admin/roles') }}" >角色管理</a>
                    </dd>
                    <dd>
                        <a lay-href="{{ url('admin/permissions') }}">权限管理</a>
                    </dd>
                </dl>
            </li>

            <li data-name="component" class="layui-nav-item">
                <a href="javascript:;" lay-tips="组件" lay-direction="2">
                    <i class="layui-icon layui-icon-component"></i>
                    <cite>组件</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="grid">
                        <a href="javascript:;">栅格</a>
                        <dl class="layui-nav-child">
                            <dd data-name="list"><a lay-href="component/grid/list.html">等比例列表排列</a></dd>
                            <dd data-name="mobile"><a lay-href="component/grid/mobile.html">按移动端排列</a></dd>
                            <dd data-name="mobile-pc"><a lay-href="component/grid/mobile-pc.html">移动桌面端组合</a></dd>
                            <dd data-name="all"><a lay-href="component/grid/all.html">全端复杂组合</a></dd>
                            <dd data-name="stack"><a lay-href="component/grid/stack.html">低于桌面堆叠排列</a></dd>
                            <dd data-name="speed-dial"><a lay-href="component/grid/speed-dial.html">九宫格</a></dd>
                        </dl>
                    </dd>
                    <dd data-name="button">
                        <a lay-href="component/button/index.html">按钮</a>
                    </dd>
                    <dd data-name="form">
                        <a href="javascript:;">表单</a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="component/form/element.html">表单元素</a></dd>
                            <dd><a lay-href="component/form/group.html">表单组合</a></dd>
                        </dl>
                    </dd>
                    <dd data-name="nav">
                        <a lay-href="component/nav/index.html">导航</a>
                    </dd>
                    <dd data-name="tabs">
                        <a lay-href="component/tabs/index.html">选项卡</a>
                    </dd>
                    <dd data-name="progress">
                        <a lay-href="component/progress/index.html">进度条</a>
                    </dd>
                    <dd data-name="panel">
                        <a lay-href="component/panel/index.html">面板</a>
                    </dd>
                    <dd data-name="badge">
                        <a lay-href="component/badge/index.html">徽章</a>
                    </dd>
                    <dd data-name="timeline">
                        <a lay-href="component/timeline/index.html">时间线</a>
                    </dd>
                    <dd data-name="anim">
                        <a lay-href="component/anim/index.html">动画</a>
                    </dd>
                    <dd data-name="auxiliar">
                        <a lay-href="component/auxiliar/index.html">辅助</a>
                    </dd>
                    <dd data-name="layer">
                        <a href="javascript:;">通用弹层<span class="layui-nav-more"></span></a>
                        <dl class="layui-nav-child">
                            <dd data-name="list">
                                <a lay-href="component/layer/list.html">功能演示</a>
                            </dd>
                            <dd data-name="special-demo">
                                <a lay-href="component/layer/special-demo.html">特殊示例</a>
                            </dd>
                            <dd data-name="theme">
                                <a lay-href="component/layer/theme.html">风格定制</a>
                            </dd>
                        </dl>
                    </dd>
                    <dd data-name="laydate">
                        <a lay-href="component/laydate/index.html">日期时间</a>
                    </dd>
                    <dd data-name="table">
                        <a lay-href="component/table/index.html">表格</a>
                    </dd>
                    <dd data-name="laypage">
                        <a lay-href="component/laypage/index.html">分页</a>
                    </dd>
                    <dd data-name="upload">
                        <a lay-href="component/upload/index.html">上传</a>
                    </dd>
                    <dd data-name="carousel">
                        <a lay-href="component/carousel/index.html">轮播</a>
                    </dd>
                    <dd data-name="laytpl">
                        <a lay-href="component/laytpl/index.html">模板引擎</a>
                    </dd>
                    <dd data-name="flow">
                        <a lay-href="component/flow/index.html">流加载</a>
                    </dd>
                    <dd data-name="util">
                        <a lay-href="component/util/index.html">工具</a>
                    </dd>
                    <dd data-name="code">
                        <a lay-href="component/code/index.html">代码修饰</a>
                    </dd>
                </dl>
            </li>
            <li data-name="template" class="layui-nav-item">
                <a href="javascript:;" lay-tips="模板" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>模板</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="user/reg.html" target="_blank">注册</a></dd>
                    <dd><a href="user/login.html" target="_blank">登入</a></dd>
                    <dd><a href="user/forget.html" target="_blank">忘记密码</a></dd>

                    <dd><a lay-href="template/tips/404.html">404页面不存在</a></dd>
                    <dd><a lay-href="template/tips/error.html">错误提示</a></dd>

                    <dd><a lay-href="http://www.baidu.com/">百度一下</a></dd>
                    <dd><a lay-href="http://www.layui.com/">layui官网</a></dd>
                    <dd><a lay-href="http://www.layui.com/admin/">layuiAdmin官网</a></dd>
                </dl>
            </li>
            <li data-name="app" class="layui-nav-item">
                <a href="javascript:;" lay-tips="应用" lay-direction="2">
                    <i class="layui-icon layui-icon-app"></i>
                    <cite>应用</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a lay-href="app/message/index.html">消息中心</a>
                    </dd>
                </dl>
            </li>
            <li data-name="senior" class="layui-nav-item">
                <a href="javascript:;" lay-tips="高级" lay-direction="2">
                    <i class="layui-icon layui-icon-senior"></i>
                    <cite>高级</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a layadmin-event="im">LayIM 通讯系统</a>
                    </dd>
                </dl>
            </li>
            <li data-name="set" class="layui-nav-item">
                <a href="javascript:;" lay-tips="设置" lay-direction="2">
                    <i class="layui-icon layui-icon-set"></i>
                    <cite>设置</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="javascript:;">系统设置</a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="set/system/website.html">网站设置</a></dd>
                            <dd><a lay-href="set/system/email.html">邮件服务</a></dd>
                        </dl>
                    </dd>
                    <dd>
                        <a href="javascript:;">我的设置</a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="set/user/info.html">基本资料</a></dd>
                            <dd><a lay-href="set/user/password.html">修改密码</a></dd>
                        </dl>
                    </dd>
                </dl>
            </li>
            <li data-name="get" class="layui-nav-item">
                <a href="javascript:;" lay-href="system/get.html" lay-tips="授权" lay-direction="2">
                    <i class="layui-icon layui-icon-auz"></i>
                    <cite>授权</cite>
                </a>
            </li>
        </ul>
    </div>
</div>