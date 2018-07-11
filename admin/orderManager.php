<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/10
 * Time: 18:22
 */
include "connectSQL.php";
$sql="select * from orders";
if($result=mysqli_query($coon,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        $data[]=$row;
    }
}
else
    $data=array();
$num=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台管理系统</title>
    <link rel="icon" type="text/css" href="../images/logo.ico">
    <link rel="stylesheet" href="../styles/index-style.css">
    <link rel="stylesheet" href="../styles/allset.css">
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <script src="../scripts/jquery-3.3.1.min.js"></script>
    <script src="../scripts/bootstrap.js"></script>
</head>
<body style="margin: 0 auto;">

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 style="display: inline;">鲜花销售后台管理系统</h1>
            <?php
            session_start();
            if($_SESSION['user']=="")
                echo "<script>alert('请您先登录系统！即将跳转到登录页面。。。');window.location.href='../login.php';</script>";
            else {
                echo "<p class='text-right' style='float: right;display: inline;margin-top: 10px;'>欢迎您，" . $_SESSION['user'] . "！  " . "<a class='btn btn-danger btn-xs'  href='../loginOut.php'>退出登录</a>" . "</p>";
            }
            ?>
        </div>
    </div>
    <div class="navbar navbar-default">
        <ul class="nav nav-pills navbar-nav">
            <li><a href="manage.php">首页</a></li>
            <li><a href="userManager.php">用户管理</a></li>
            <li><a href="goodManager.php">商品管理</a></li>
            <li class="active"><a href="orderManager.php">订单管理</a></li>
            <li><a href="commentManager.php">评论管理</a></li>
            <li><a href="sizeManager.php">规格配置</a></li>
            <li><a href="soldAnalysis.php">销售分析</a></li>
        </ul>
    </div>
    <form class="navbar-form navbar-right" method="post" action="orderSearch.php">
        <p style="display: inline;">当前共有<?php echo mysqli_num_rows($result); ?>条订单信息&nbsp;&nbsp;&nbsp;</p>
        <div class="form-group">
            <input type="text" class="form-control" name="ordersearch" placeholder="请输入订单号检索信息" />
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th style='width: 60px;'>订单ID</th>
            <th style='width: 80px;'>商品id及数量（用|分割）</th>
            <th style='width: 60px;'>用户名</th>
            <th style='width: 90px;'>收件人姓名</th>
            <th style='width: 90px;'>联系电话</th>
            <th style='width: 100px;'>收货地址</th>
            <th style='width: 30px;'>留言</th>
            <th style='width: 45px;'>订单金额</th>
            <th style='width: 30px;'>是否付款</th>
            <th style='width: 130px;'>生成时间</th>
            <th style="width: 110px;">操作</th>
        </tr>
        </thead>
        <tbody style="font-size: 6px;">
        <?php

        if(!empty($data)) {
            foreach ($data as $value) {
                ?>
                <tr>
                    <td><?php echo $value['OrderId']; ?></td>
                    <td><?php echo $value['Goods']; ?></td>
                    <td><?php echo $value['UserName']; ?></td>
                    <td><?php echo $value['ReceiveName']; ?></td>
                    <td><?php echo $value['Phone']; ?></td>
                    <td><?php echo $value['Address']; ?></td>
                    <td><?php echo $value['Words']; ?></td>
                    <td><?php echo $value['OrderPrice']; ?></td>
                    <td><?php echo $value['IsPaid']; ?></td>
                    <td><?php echo $value['OrderTime']; ?></td>
                    <td><a class="btn btn-info btn-xs" href="orderChange.php?id=<?php echo $value['OrderId'] ?>">修改</a>
                        <a class="btn btn-danger btn-xs" href="orderDel.php?id=<?php echo $value['OrderId'] ?>">删除</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>