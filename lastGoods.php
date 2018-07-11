<?php
include "connectSQL.php";
//$sql="select * from goods";
session_start();
$order=$_GET['order'];
switch ($order){
    case '':
    case 'default':
        $sql="select * from goods where date_sub(curdate(),interval 30 day)<= UpdateTime";
        break;
    case 'timefromnew':
        $sql="select * from goods where date_sub(curdate(),interval 30 day)<= UpdateTime order by UpdateTime desc";
        break;
    case 'timefromold':
        $sql="select * from goods where date_sub(curdate(),interval 30 day)<= UpdateTime order by UpdateTime";
        break;
    case 'pricefromhigh':
        $sql="select * from goods where date_sub(curdate(),interval 30 day)<= UpdateTime order by GoodPrice1 desc";
        break;
    case 'pricefromlow':
        $sql="select * from goods where date_sub(curdate(),interval 30 day)<= UpdateTime order by GoodPrice1";
        break;
    case 'soldfromhigh':
        $sql="select * from goods where date_sub(curdate(),interval 30 day)<= UpdateTime order by SoldNumber desc";
        break;
    case 'soldfromlow':
        $sql="select * from goods where date_sub(curdate(),interval 30 day)<= UpdateTime order by SoldNumber";
        break;
}
if($result=mysqli_query($coon,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        $data[]=$row;
    }
}
else
    $data=array();
$num=mysqli_num_rows($result);
$user=$_SESSION['user'];
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
    <title>法兰沃----懂你的心</title>
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
            <p style="display: inline;color: white;">当前共有<?php echo mysqli_num_rows($result); ?>条商品信息&nbsp;&nbsp;&nbsp;</p>
            <div class="form-group">
                <input type="text" class="form-control" name="goodsearch" placeholder="请输入商品名检索信息" />
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <hr>
    <div class="panel panel-default">
        <div class="panel-body search-firstline">
            <span style="float: left;line-height: 20px;margin-left: 30px;margin-right: 20px;">排序</span>
            <ul>
                <li style="margin-right: 40px;<?php echo ($order=='default'||$order=='')?"font-weight:bolder":"";?>"><a href="lastGoods.php?order=default">默认排序</a></li>
                <li style="margin-right: 40px;<?php echo ($order=='timefromnew')?"font-weight:bolder":"";?>"><a href="lastGoods.php?order=timefromnew">按时间降序排序</a></li>
                <li style="margin-right: 40px;<?php echo ($order=='timefromold')?"font-weight:bolder":"";?>"><a href="lastGoods.php?order=timefromold">按时间升序排序</a></li>
                <li style="margin-right: 40px;<?php echo ($order=='pricefromhigh')?"font-weight:bolder":"";?>"><a href="lastGoods.php?order=pricefromhigh">按价格从高到低</a></li>
                <li style="margin-right: 40px;<?php echo ($order=='pricefromlow')?"font-weight:bolder":"";?>"><a href="lastGoods.php?order=pricefromlow">按价格从低到高</a></li>
                <li style="margin-right: 40px;<?php echo ($order=='soldfromhigh')?"font-weight:bolder":"";?>"><a href="lastGoods.php?order=soldfromhigh">按销量从高到低</a></li>
                <li style="margin-right: 40px;<?php echo ($order=='soldfromlow')?"font-weight:bolder":"";?>"><a href="lastGoods.php?order=soldfromlow">按销量从低到高</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <?php

        if(!empty($data)) {
            foreach ($data as $value) {
                ?>
                <div class="col-md-4">
                    <div><?php $imagepath="./".$value['GoodImage'];$href="goodDetail.php?id=".$value['GoodId']; echo "<a href='$href'><img class='img-rounded' style='width: 100%;height: 500px;' src='$imagepath'></a>"; ?></div>
                    <h5>
                        <span>THE FLOWER</span><br>
                        <span style="font-size: 18px;font-family: Arial;">￥<?php echo $value['GoodPrice1']; ?></span><br>
                        <span style="color: #ff4400;font-size: 18px;">VIP：<strong>￥<?php echo $value['GoodPrice2']; ?></strong></span>
                        <span style="float: right;color: #828282;">已有<?php echo $value['SoldNumber']; ?>人购买</span><br>
                        <span><?php echo $value['GoodName']; ?></span><br>
                        <span style="color: #828282;"><?php echo $value['GoodSummary']; ?></span><br>
                        <span>
                                <a class="btn btn-info btn-xs" href="goodDetail.php?id=<?php echo $value['GoodId'] ?>">查看详情</a>
                                <a class="btn btn-danger btn-xs" style="color: #F22D00;" href="cartAddHandle.php?id=<?php echo $value['GoodId'] ?>"><span style="color: white;">加入购物车</span></a>
                            </span>
                    </h5>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("li").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
        })
    })
</script>
</body>
</html>