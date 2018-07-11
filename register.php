<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册页面</title>
    <link rel="icon" type="text/css" href="./images/logo.ico">
    <link rel="stylesheet" href="styles/index-style.css">
    <link rel="stylesheet" href="styles/allset.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <script src="scripts/bootstrap.min.js"></script>
</head>
<body style="margin: 0 auto;background-image: url('images/Login-background.png');background-repeat:no-repeat; -webkit-background-size: 100%;background-size: 100%;">
<div class="content">
    <div class="title">
        <div class="title-left">欢迎来到法兰沃鲜花购物网站!
            <?php
            session_start();
            if($_SESSION['user']=="")
                echo "<a class='btn btn-success btn-xs' href='login.php'>登录</a>"."&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-xs'  href='register.php' disabled='disabled'>注册</a>";
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
<form method="post" action="registerHandle.php" role="form" style="width: 300px;margin: 0 auto; margin-top: 60px;">
    <div class="form-group">
        <label class="control-label" for="username">用户名：</label>
        <input class="form-control" type="text" name="username" size="20" placeholder="请输入用户名：">
    </div>
    <div class="form-group">
        <label class="control-label" for="truename">真实姓名：</label>
        <input class="form-control" type="text" name="truename" size="20" placeholder="请输入真实姓名：">
    </div>
    <div class="form-group">
        <label class="control-label" for="password">密码：</label>
        <input class="form-control" type="password" name="password" size="20" placeholder="请输入密码：">
    </div>
    <div class="form-group">
        <label class="control-label" for="password-confirm">确认密码：</label>
        <input class="form-control" type="password" name="password-confirm" size="20" placeholder="请再次输入密码：">
    </div>
    <div class="form-group">
        <label class="control-label" for="usersex">性别：</label>
        <select class="form-control" name="usersex">
            <option value ="男">男</option>
            <option value ="女">女</option>
            <option value="保密">保密</option>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="userage">年龄：</label>
        <input class="form-control" type="text" name="userage">
    </div>
    <div class="form-group">
        <label class="control-label" for="useremail">邮箱：</label>
        <input class="form-control" type="text" name="useremail">
    </div>
    <div class="form-group">
        <label class="control-label" for="userphone">联系电话：</label>
        <input class="form-control" type="text" name="userphone">
    </div>
    <div class="form-group">
        <label class="control-label" for="useraddress">常用地址：</label>
        <input class="form-control" type="text" name="useraddress"><br>
    </div>
    <input class="btn btn-info" type="submit" value="注册">&nbsp;&nbsp;&nbsp;
    <input class="btn btn-default" type="reset" value="重置">
</form>
</body>
</html>