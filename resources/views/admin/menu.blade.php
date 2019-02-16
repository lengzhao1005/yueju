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

            <li data-name="com" class="layui-nav-item">
                <a href="javascript:;" lay-tips="小区管理" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>小区管理</cite>
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

            <li  data-name="com" class="layui-nav-item">
                <a href="javascript:;" lay-tips="商铺管理" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>商铺管理</cite>
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

            <li>
                <a href="javascript:;" lay-tips="公司管理" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>公司管理</cite>
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

            <li>
                <a href="javascript:;" lay-tips="标签管理" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>标签管理</cite>
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

        </ul>
    </div>
</div>