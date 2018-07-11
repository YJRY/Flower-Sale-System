<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/27
 * Time: 18:16
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
            <li><a href="goodManager.php">商品管理</a></li>
            <li><a href="orderManager.php">订单管理</a></li>
            <li><a href="commentManager.php">评论管理</a></li>
            <li class="active"><a href="sizeManager.php">规格配置</a></li>
            <li><a href="soldAnalysis.php">销售分析</a></li>
        </ul>
    </div>
    <h4>添加规格配置</h4>
    <form method="post" action="sizeAddHandle.php" enctype="multipart/form-data" role="form" style="width: 300px;margin: 0 auto; margin-top: 20px;">
        <div class="form-group">
            <label class="control-label" for="hmgnum">红玫瑰数量：</label>
            <input class="form-control" type="text" name="hmgnum">
        </div>
        <div class="form-group">
            <label class="control-label" for="mtxnum">满天星数量：</label>
            <input class="form-control" type="text" name="goodsummary">
        </div>
        <div class="form-group">
            <label class="control-label" for="bhnum">百合数量：</label>
            <input class="form-control" type="text" name="bhnum">
        </div>
        <div class="form-group">
            <label class="control-label" for="zmgnum">紫玫瑰数量：</label>
            <input class="form-control" type="text" name="zmgnum">
        </div>
        <div class="form-group">
            <label class="control-label" for="lmgnum">蓝玫瑰数量：</label>
            <input class="form-control" type="text" name="lmgnum">
        </div>
        <div class="form-group">
            <label class="control-label" for="yjxnum">郁金香数量：</label>
            <input class="form-control" type="text" name="yjxnum">
        </div>
        <div class="form-group">
            <label class="control-label" for="bmgnum">白玫瑰数量：</label>
            <input class="form-control" type="text" name="bmgnum">
        </div>
        <div class="form-group">
            <label class="control-label" for="xrknum">向日葵数量：</label>
            <input class="form-control" type="text" name="xrknum">
        </div>
        <div class="form-group">
            <label class="control-label" for="knxnum">康乃馨数量：</label>
            <input class="form-control" type="text" name="knxnum">
        </div>
        <div class="form-group">
            <label class="control-label" for="mlynum">玛利亚数量：</label>
            <input class="form-control" type="text" name="mlynum">
        </div>
        <button class="btn btn-info" type="submit">添加规格</button>
        <button class="btn btn-default" type="reset">重置</button>
    </form>
</div>
</body>
</html>