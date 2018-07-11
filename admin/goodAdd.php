<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/8
 * Time: 13:41
 */
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
            <li class="active"><a href="goodManager.php">商品管理</a></li>
            <li><a href="orderManager.php">订单管理</a></li>
            <li><a href="commentManager.php">评论管理</a></li>
            <li><a href="sizeManager.php">规格配置</a></li>
            <li><a href="soldAnalysis.php">销售分析</a></li>
        </ul>
    </div>
    <h4>添加商品信息</h4>
    <form method="post" action="goodAddHandle.php" enctype="multipart/form-data" role="form" style="width: 300px;margin: 0 auto; margin-top: 20px;">
        <div class="form-group">
            <label class="control-label" for="goodname">商品名称：</label>
            <input class="form-control" type="text" name="goodname" size="20">
        </div>
        <div class="form-group">
            <label class="control-label" for="goodsummary">商品简介：</label>
            <input class="form-control" type="text" name="goodsummary" size="20">
        </div>
        <div class="form-group">
            <label class="control-label" for="goodprice1">普通价格：</label>
            <input class="form-control" type="text" name="goodprice1" size="20">
        </div>
        <div class="form-group">
            <label class="control-label" for="goodprice2">会员价格：</label>
            <input class="form-control" type="text" name="goodprice2" size="20">
        </div>
        <div class="form-group">
            <label class="control-label" for="goodnumber">商品数量：</label>
            <input class="form-control" type="text" name="goodnumber">
        </div>
        <div class="form-group">
            <label class="control-label" for="soldnumber">已售数量：</label>
            <input class="form-control" type="text" name="soldnumber">
        </div>
        <div class="form-group">
            <label class="control-label" for="goodsize">规格参数：</label>
            <input class="form-control" type="text" name="goodsize">
        </div>
        <div class="form-group">
            <label class="control-label" for="goodmessage">详细信息：</label>
            <input class="form-control" type="text" name="goodmessage">
        </div>
        <div class="form-group">
            <label class="control-label" for="goodimage">商品图片：</label>
            <input class="form-control" type="file" name="goodimage">
        </div>
        <button class="btn btn-info" type="submit">添加商品</button>
        <button class="btn btn-default" type="reset">重置</button>
    </form>
</div>
</body>
</html>
