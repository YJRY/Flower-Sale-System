<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/28
 * Time: 18:16
 */
session_start();
include "connectSQL.php";
$id=$_GET['userid'];
$user=$_SESSION['user'];
$sql="select * from users where UserId=$id";
if($result=mysqli_query($coon,$sql)){
    $data=mysqli_fetch_assoc($result);
}
if($user!='') {
    $sql1 = "select * from users where UserName='$user'";
    $result1 = mysqli_query($coon, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户信息修改</title>
    <link rel="icon" type="text/css" href="./images/logo.ico">
    <link rel="stylesheet" href="styles/index-style.css">
    <link rel="stylesheet" href="styles/allset.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <script src="scripts/bootstrap.min.js"></script>
</head>
<body style="margin: 0 auto;background-repeat:no-repeat; -webkit-background-size: 100%;background-size: 100%;">
<div class="content">
    <div class="title">
        <div class="col-md-4" style="margin-top: 30px;">欢迎来到法兰沃鲜花购物网站!
            <?php

            if($_SESSION['user']=="")
                echo "<a class='btn btn-success btn-xs' href='login.php'>登录</a>"."&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-xs'  href='register.php'>注册</a>";
            else {
                echo '<p>欢迎您，'.'<a href="userInfo.php"><img class="img-rounded" style="width: 30px;height: 30px;" src="'.$row1['UserImage'].'" title="'.$user.'"></a>'.'<a class="btn btn-danger btn-xs"  href="loginOut.php">退出登录</a>'.'</p>';
            }
            ?>
        </div>

        <div class="title-logo">
            <img src="./images/title-logo.jpg" alt="法兰沃">
        </div>
    </div>
    <hr style="height: 2px;background-color: black;border: 1px solid black;">
    <h3>用户信息修改</h3>
    <form method="post" action="userInfoChangeHandle.php?userid=<?php echo $id;?>" role="form" enctype="multipart/form-data" style="width: 300px;margin: 0 auto; margin-top: 60px;">
        <div class="form-group">
            <label class="control-label" for="username">用户名：</label>
            <input class="form-control" type="text" name="username" size="20" value="<?php echo $data['UserName']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="truename">真实姓名：</label>
            <input class="form-control" type="text" name="truename" size="20" value="<?php echo $data['TrueName']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="password">密码：</label>
            <input class="form-control" type="password" name="password" size="20" value="<?php echo $data['UserPassword']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="password-confirm">确认密码：</label>
            <input class="form-control" type="password" name="password-confirm" size="20" placeholder="请再次输入密码：">
        </div>
        <div class="form-group">
            <label class="control-label" for="usersex">性别：</label>
            <select class="form-control" name="usersex">
                <option value ="男" <?php if($data['UserSex']=='男')echo "selected='selected'";else echo "";?>>男</option>
                <option value ="女" <?php if($data['UserSex']=='女')echo "selected='selected'";else echo "";?>>女</option>
                <option value="保密" <?php if($data['UserSex']=='保密')echo "selected='selected'";else echo "";?>>保密</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label" for="userage">年龄：</label>
            <input class="form-control" type="text" name="userage" value="<?php echo $data['UserAge']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="useremail">邮箱：</label>
            <input class="form-control" type="text" name="useremail" value="<?php echo $data['UserEmail']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="userphone">联系电话：</label>
            <input class="form-control" type="text" name="userphone" value="<?php echo $data['UserPhone']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="useraddress">常用地址：</label>
            <input class="form-control" type="text" name="useraddress" value="<?php echo $data['UserAddress']; ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="userimage">用户头像：</label>
            <input class="form-control" type="file" name="userimage">
        </div>
        <button class="btn btn-info" type="submit">提交修改</button>
    </form>
</body>
</html>
