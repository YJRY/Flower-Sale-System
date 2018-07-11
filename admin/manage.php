<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/7
 * Time: 20:18
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
    <script src="../scripts/bootstrap.min.js"></script>
    <script src="../scripts/bootstrap.js"></script>
    <script src="../scripts/jquery-3.3.1.min.js"></script>
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
            <li class="active"><a href="manage.php">首页</a></li>
            <li><a href="userManager.php">用户管理</a></li>
            <li><a href="goodManager.php">商品管理</a></li>
            <li><a href="orderManager.php">订单管理</a></li>
            <li><a href="commentManager.php">评论管理</a></li>
            <li><a href="sizeManager.php">规格配置</a></li>
            <li><a href="soldAnalysis.php">销售分析</a></li>
        </ul>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h1>后台管理系统</h1>
        </div>
        <div class="panel-body">
            <p>本网站是个人开发的小项目，目前实现的功能比较少，很不全面，另外网页操作界面还是有一些不美观。总的来说
                本网站有很多小缺陷，期待在日后，我们可以将其功能和界面修缮，以达到用户的需求。
            </p>
            <h3>系统信息</h3>
            <table class="table table-bordered">
                <tr>
                    <th>操作系统</th>
                    <td><?php echo PHP_OS;?></td>
                </tr>
                <tr>
                    <th>PHP版本</th>
                    <td><?php echo PHP_VERSION;?></td>
                </tr>
                <tr>
                    <th>运行方式</th>
                    <td><?php echo PHP_SAPI;?></td>
                </tr>
            </table>
            <h3>网站信息</h3>
            <table class="table table-bordered">
                <tr>
                    <th>系统名称</th>
                    <td>法兰沃鲜花购物商城</td>
                </tr>

                <tr>
                    <th>网站首页</th>
                    <td><a class="btn btn-info" href="../index.php">点击这里跳转到网站首页</a></td>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
            开发者：Yjry
        </div>
    </div>

</div>
</body>
</html>
