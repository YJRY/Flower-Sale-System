<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/26
 * Time: 22:06
 */
include "connectSQL.php";
//$sql="select * from goods";
session_start();
$user=$_SESSION['user'];
$sql="select * from orders where UserName='$user'";
if($result=mysqli_query($coon,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        $data[]=$row;
    }
}
else
    $data=array();
if($user!='') {
    $sql1 = "select * from users where UserName='$user'";
    $result1 = mysqli_query($coon, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>个人中心</title>
    <link rel="icon" type="text/css" href="./images/logo.ico">
    <link rel="stylesheet" href="styles/index-style.css">
    <link rel="stylesheet" href="styles/allset.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/fontawesome-all.css">
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/jquery-3.3.1.min.js"></script>
</head>
<body style="margin: 0 auto;">
<div class="content">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-4" style="margin-top: 30px;">欢迎来到法兰沃鲜花购物网站!
            <?php

            if($_SESSION['user']=="")
                echo "<a class='btn btn-success btn-xs' href='login.php'>登录</a>"."&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-xs'  href='register.php'>注册</a>";
            else {
                echo '<p>欢迎您，'.'<a href="userInfo.php"><img class="img-rounded" style="width: 30px;height: 30px;" src="'.$row1['UserImage'].'" title="'.$_SESSION['user'].'"></a>'.'<a class="btn btn-danger btn-xs"  href="loginOut.php">退出登录</a>'.'</p>';
            }
            ?>
        </div>
        <div class="col-md-5">
            <img src="./images/title-logo.jpg" alt="法兰沃">
        </div>
        <div class="col-md-3" style="margin-top: 30px;padding-left: 150px;">
            <a class="" href="shoppingCart.php" style="font-size: 15px;text-decoration: none;color: black;">查看购物车
                <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
            </a>
        </div>
    </div>
    <hr style="height: 2px;background-color: black;border: 1px solid black;">

    <div class="navbar navbar-inverse">
        <ul class="nav nav-pills navbar-nav">
            <li><a href="index.php">首页</a></li>
            <li><a href="lastGoods.php">新品上市</a></li>
            <li><a href="hotGoods.php">最热爆款</a></li>
        </ul>
        <form class="navbar-form navbar-right" method="post" action="goodSearch.php?order=<?php echo $order;?>">
            <div class="form-group">
                <input type="text" class="form-control" name="goodsearch" placeholder="请输入商品名检索信息" />
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <hr>
    <table class="table table-bordered">
        <thead><p style="font-size: 24px;font-weight: bold;">个人资料</p></thead>
        <tr style="font-size: 16px;">
            <td>
                <span>当前头像：</span><img style="width: 60px;height: 60px;" src="<?php echo $row1['UserImage']; ?>" alt="">
                <p>用户名：&nbsp;&nbsp;<?php echo $row1['UserName'];?></p>
                <p>真实姓名：&nbsp;&nbsp;<?php echo $row1['TrueName'];?></p>
                <p>性别：&nbsp;&nbsp;<?php echo $row1['UserSex'];?></p>
                <p>年龄：&nbsp;&nbsp;<?php echo $row1['UserAge'];?></p>
                <p>邮箱：&nbsp;&nbsp;<?php echo $row1['UserEmail'];?></p>
                <p>联系电话：&nbsp;&nbsp;<?php echo $row1['UserPhone'];?></p>
                <p>常用地址：&nbsp;&nbsp;<?php echo $row1['UserAddress'];?></p>
                <p>注册时间：&nbsp;&nbsp;<?php echo $row1['RegisterTime'];?></p>
                <p>已消费金额：&nbsp;&nbsp;<?php echo $row1['ConsumeNum'];?></p>
                <p>是否为VIP：&nbsp;&nbsp;<?php if($row1['IsVIP']=='0') echo "否";else echo "是";?><a style="text-decoration: none;" href="VIPExplain.php">&nbsp;&nbsp;什么是VIP？</a></p>
                <a class="btn btn-info" type="button" href="userInfoChange.php?userid=<?php echo $row1['UserId']?>">修改个人信息</a>
            </td>
        </tr>
    </table>
    <table class="table table-bordered">
        <thead><p style="font-size: 24px;font-weight: bold;">订单记录</p></thead>
        <tr style="font-size: 16px;">
            <td>
                <a style="text-decoration: none;" href="orderShow.php">查看我的订单</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>