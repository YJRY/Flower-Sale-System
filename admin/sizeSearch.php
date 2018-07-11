<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/28
 * Time: 19:55
 */
include "connectSQL.php";
$sizesearch=$_POST['sizesearch'];
$sql="select * from goodsizes where SizeId='$sizesearch'";
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
            <li><a href="orderManager.php">订单管理</a></li>
            <li><a href="commentManager.php">评论管理</a></li>
            <li class="active"><a href="sizeManager.php">规格配置</a></li>
            <li><a href="soldAnalysis.php">销售分析</a></li>
        </ul>
    </div>
    <form class="navbar-form navbar-right" method="post" action="sizeSearch.php">
        <p style="display: inline;">当前共有<?php echo mysqli_num_rows($result); ?>条规格信息&nbsp;&nbsp;&nbsp;</p>
        <a class="btn btn-primary" href="sizeAdd.php">添加规格信息</a>
        <div class="form-group">
            <input type="text" class="form-control" name="sizesearch" placeholder="请输入规格号检索信息" />
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th style='width: 60px;'>规格ID</th>
            <th style='width: 130px;'>规格配置</th>
            <th style="width: 110px;">操作</th>
        </tr>
        </thead>
        <tbody style="font-size: 6px;">
        <?php

        if(!empty($data)) {
            foreach ($data as $value) {
                ?>
                <tr>
                    <td><?php echo $value['SizeId']; ?></td>
                    <td>
                        <?php
                        if($value['红玫瑰']!=0)
                            echo $value['红玫瑰']."朵红玫瑰    ";
                        if($value['满天星']!=0)
                            echo $value['满天星']."朵满天星    ";
                        if($value['百合']!=0)
                            echo $value['百合']."朵百合    ";
                        if($value['紫玫瑰']!=0)
                            echo $value['紫玫瑰']."朵紫玫瑰    ";
                        if($value['蓝玫瑰']!=0)
                            echo $value['蓝玫瑰']."朵蓝玫瑰    ";
                        if($value['郁金香']!=0)
                            echo $value['郁金香']."朵郁金香    ";
                        if($value['白玫瑰']!=0)
                            echo $value['白玫瑰']."朵白玫瑰    ";
                        if($value['向日葵']!=0)
                            echo $value['向日葵']."朵向日葵    ";
                        if($value['康乃馨']!=0)
                            echo $value['康乃馨']."朵康乃馨    ";
                        if($value['玛利亚']!=0)
                            echo $value['玛利亚']."朵玛利亚    ";
                        ?>
                    </td>
                    <td><a class="btn btn-info btn-xs" href="sizeChange.php?id=<?php echo $value['SizeId'] ?>">修改</a>
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