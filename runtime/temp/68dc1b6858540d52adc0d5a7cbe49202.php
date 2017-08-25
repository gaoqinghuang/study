<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"F:\PHP\wampserver\wamp\www\blog\public/../application/admin\view\login\login.html";i:1501122152;}*/ ?>
<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
    <meta charset="utf-8"/>
    <title>小高博客后台登陆</title>
    <meta name="description"content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link href="__STATIC__/admin/bootstrap-3.3.0-dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="__STATIC__/admin/admin.ui/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="__STATIC__/admin/admin.ui/css/app.css" type="text/css"/>
    <style type="text/css">
        #register{float: right;}
    </style>
</head>
<body class="">
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xxl">
        <a class="navbar-brand block" href="">小高博客后台管理</a>
        <section class="panel panel-default bg-white m-t-lg">
            <header class="panel-heading text-center">
                <strong>管理员后台登陆</strong>
            </header>
            <form method="post" action="" class="panel-body wrapper-lg">
                <div class="form-group">
                    <label class="control-label">用户名</label>
                    <input  type="text" class="form-control input-lg" name="admin_username">
                </div>
                <div class="form-group">
                    <label class="control-label">密 码</label>
                    <input  type="password"  class="form-control input-lg" name="admin_password">
                </div>
                <div class="form-group">
                    <label class="control-label">验证码</label>
                    <input type="text"  class="form-control input-lg col-md-6" name="code">
                    <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src=this.src+'?'+Math.random()"/>
                </div>
                <button type="submit" class="btn btn-primary">登陆后台</button>
                <a href="<?php echo url('/admin/register/register'); ?>">
                    <button type="button" class="btn btn-primary" id="register">注册</button>
                </a>
            </form>
        </section>
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="text-center padder">
        <p>
            <small>Powered By 617103154@qq.com<br> copyright &copy; 2017</small>
        </p>
    </div>
</footer>
<script src="__STATIC__/admin/admin.ui/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="__STATIC__/admin/admin.ui/js/bootstrap.js"></script>
<!-- App -->
<script src="__STATIC__/admin/admin.ui/js/app.js"></script>
<script src="__STATIC__/admin/admin.ui/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="__STATIC__/admin/admin.ui/js/app.plugin.js"></script>
</body>
</html>