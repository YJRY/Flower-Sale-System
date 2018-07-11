<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/9
 * Time: 17:50
 */
include "connectSQL.php";
$goodsearch=$_POST['goodsearch'];
$sql="select * from goods where GoodName like '%$goodsearch%'";
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
            <li class="active"><a href="goodManager.php">商品管理</a></li>
            <li><a href="orderManager.php">订单管理</a></li>
            <li><a href="commentManager.php">评论管理</a></li>
            <li><a href="sizeManager.php">规格配置</a></li>
            <li><a href="soldAnalysis.php">销售分析</a></li>
        </ul>
    </div>

    <form class="navbar-form navbar-right" method="post" action="goodSearch.php">
        <p style="display: inline;">当前共有<?php echo mysqli_num_rows($result); ?>条商品信息&nbsp;&nbsp;&nbsp;</p>
        <a class="btn btn-primary" href="goodAdd.php">添加商品</a>
        &nbsp;&nbsp;
        <div class="form-group">
            <input type="text" class="form-control" name="goodsearch" placeholder="<?php echo ($goodsearch=='')?'':$goodsearch;?>" />
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th style='width: 6%;'>商品ID</th>
            <th style='width: 7%;'>商品名称</th>
            <th style="width: 7%;">商品简介</th>
            <th style='width: 7%;'>普通价格</th>
            <th style='width: 7%;'>会员价格</th>
            <th style='width: 7%;'>商品数量</th>
            <th style="width: 7%;">已售数量</th>
            <th style="width: 7%;">规格参数</th>
            <th style='width: 21%;'>详细信息</th>
            <th style='width: 8%;'>缩略图片</th>
            <th style="width: 13%;">更新时间</th>
            <th style="width: 10%;">操作</th>
        </tr>
        </thead>
        <tbody style="font-size: 6px;">
        <?php

        if(!empty($data)) {
            foreach ($data as $value) {
                ?>
                <tr>
                    <td><?php echo $value['GoodId']; ?></td>
                    <td><?php echo $value['GoodName']; ?></td>
                    <td><?php echo $value['GoodSummary']; ?></td>
                    <td><?php echo $value['GoodPrice1']; ?></td>
                    <td><?php echo $value['GoodPrice2']; ?></td>
                    <td><?php echo $value['GoodNumber']; ?></td>
                    <td><?php echo $value['SoldNumber']; ?></td>
                    <td><?php echo $value['GoosSize']; ?></td>
                    <td><?php echo $value['GoodMessage']; ?></td>
                    <td><?php $imagepath="../".$value['GoodImage']; echo "<img class='img-circle' style='width: 60px;height: 60px;' src='$imagepath'>"; ?></td>
                    <td><?php echo $value['UpdateTime']; ?></td>
                    <td><a class="btn btn-info btn-xs" href="goodChange.php?id=<?php echo $value['GoodId'] ?>">修改</a>
                        <a class="btn btn-danger btn-xs" href="goodDel.php?id=<?php echo $value['GoodId'] ?>">删除</a>
                    </td>
                </tr>
                <?php
            }
        }
        else
            echo "<tr><td colspan='13'><h3>没有查询到相关商品信息！</h3></td></tr>";
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
