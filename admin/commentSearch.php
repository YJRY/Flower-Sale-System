<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/17
 * Time: 21:45
 */
include "connectSQL.php";
$usersearch=$_POST['usersearch'];
$sql="select * from comments where UserName like '%$usersearch%'";
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
            <li class="active"><a href="commentManager.php">评论管理</a></li>
            <li><a href="sizeManager.php">规格配置</a></li>
            <li><a href="soldAnalysis.php">销售分析</a></li>
        </ul>
    </div>

    <form class="navbar-form navbar-right" method="post" action="commentSearch.php">
        <p style="display: inline;">当前共有<?php echo mysqli_num_rows($result); ?>条评论信息&nbsp;&nbsp;&nbsp;</p>
        <div class="form-group">
            <input type="text" class="form-control" name="usersearch" placeholder="<?php echo ($usersearch=='')?'':$usersearch;?>" />
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th style='width: 5%;'>评论ID</th>
            <th style='width: 5%;'>评论时间</th>
            <th style='width: 5%;'>商品ID</th>
            <th style="width: 5%;">用户名</th>
            <th style="width: 20%;">评论详情</th>
            <th style="width: 5%;">操作</th>
        </tr>
        </thead>
        <tbody style="font-size: 6px;">
        <?php
        if(!empty($data)) {
            foreach ($data as $value) {
                ?>
                <tr>
                    <td><?php echo $value['CommentId']; ?></td>
                    <td><?php echo $value['Time']; ?></td>
                    <td><?php echo $value['GoodId']; ?></td>
                    <td><?php echo $value['UserName']; ?></td>
                    <td><?php echo $value['Content']; ?></td>
                    <td>
                        <a class="btn btn-danger btn-xs" href="commentDel.php?id=<?php echo $value['CommentId'] ?>">删除</a>
                    </td>
                </tr>
                <?php
            }
        }
        else
            echo "<tr><td colspan='13'><h3>没有查询到相关评论信息！</h3></td></tr>";
        ?>
        </tbody>
    </table>
</div>
</body>
</html>