<?php /*a:1:{s:44:"E:\www\cms\application\admin\view\login.html";i:1551363778;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入 - layuiAdmin</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/admin/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/admin/layuiadmin/style/login.css" media="all">
</head>
<body>

<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>layuiAdmin</h2>
            <p>layui 官方出品的单页面后台管理模板系统</p>
        </div>
        <form id="cms-login-form">
            <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                           for="LAY-user-login-username"></label>
                    <input type="text" name="username" id="LAY-user-login-username" lay-verify="required"
                           placeholder="用户名"
                           class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                           for="LAY-user-login-password"></label>
                    <input type="password" name="password" id="LAY-user-login-password" lay-verify="required"
                           placeholder="密码" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                                   for="LAY-user-login-vercode"></label>
                            <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required"
                                   placeholder="图形验证码" class="layui-input">
                        </div>
                        <div class="layui-col-xs5">
                            <div style="margin-left: 10px;">
                                <img src="<?php echo captcha_src(); ?>" onclick="changeCode(this)" alt="captcha"
                                     class="layadmin-user-login-codeimg"
                                     id="LAY-user-get-vercode">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item" style="margin-bottom: 20px;">
                    <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
                    <!--<a href="forget.html" class="layadmin-user-jump-change layadmin-link"-->
                       <!--style="margin-top: 7px;">忘记密码？</a>-->
                </div>
                <div class="layui-form-item">
                    <button type="button" id="cms-login" class="layui-btn layui-btn-fluid" lay-submit
                            lay-filter="LAY-user-login-submit">登 入
                    </button>
                </div>

            </div>
        </form>
    </div>

    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2018 <a href="http://www.layui.com/" target="_blank">layui.com</a></p>
    </div>
</div>

<script src="/static/admin/layuiadmin/layui/layui.js"></script>
<script src="/static/js/jquery-3.3.1.min.js"></script>
<script src="/static/js/ajax.js"></script>
<script src="/static/js/function.js"></script>

</body>
</html>