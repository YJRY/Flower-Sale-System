<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <link rel="icon" type="text/css" href="./images/logo.ico">
    <link rel="stylesheet" href="styles/index-style.css">
    <link rel="stylesheet" href="styles/allset.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">

</head>
<body style="margin: 0 auto;background-image: url('images/Login-background.png');background-repeat:no-repeat; -webkit-background-size: 100%;background-size: 100%;">
<div class="content">
    <div class="title">
        <div class="title-left">欢迎来到法兰沃鲜花购物网站!
            <?php
            session_start();
            if($_SESSION['user']=="")
                echo "<a class='btn btn-success btn-xs' href='login.php' disabled='disabled'>登录</a>"."&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-xs'  href='register.php'>注册</a>";
            else {
                echo "<script>alert('您已经登录成功！现在将跳转回首页。。。');window.location.href='index.php';</script>";
                echo "<p>欢迎您，" . $_SESSION['user'] . "！  " . "<a class='btn btn-danger btn-xs'  href='loginOut.php'>退出登录</a>" . "</p>";
            }
            ?>
            <!--                <a href="#" class="">欢迎您，--><?php //echo $_SESSION['user'];?><!--</a>-->
            <!--                <a href="Register.php">注册</a>-->
        </div>
        <div class="title-logo">
            <img src="./images/title-logo.jpg" alt="法兰沃">
        </div>
    </div>
    <hr style="height: 2px;background-color: black;border: 1px solid black;">
<form role="form" class="" method="post" action="loginHandle.php" style="width: 300px;margin: 0 auto;margin-top: 250px;">
        <div class="form-group form-inline">
            <label class="control-label" for="username">用户名：</label>
            <input class="form-control" type="text" name="username" size="20" placeholder="请输入用户名：">
        </div>
        <div class="form-group form-inline">
            <label class="control-label" for="password">密&nbsp;&nbsp;&nbsp;码：</label>
            <input class="form-control" type="password" name="password" size="20" placeholder="请输入密码：">
        </div>
        <div class="form-group form-inline">
            <button class="form-control col-xs-3 btn btn-success" type="submit">登录</button>
            <label class="control-label col-xs-6" for="register">
                <a class="form-control btn btn-info" href="register.php">注册</a>
        </div>
</form>

</body>
</html>