<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/25
 * Time: 18:51
 */
include "connectSQL.php";
session_start();
$user=$_SESSION['user'];
$orderlist=array();
$goodlist=array();
$sql="select * from orders where UserName='$user'order by OrderTime desc";
$result=mysqli_query($coon,$sql);
while ($row = mysqli_fetch_assoc($result)){
    $data[]=$row;
}
for($i=0;$i<sizeof($data);$i++) {
//    echo $data[$i]['Goods'];
    $orderlist[$i]=explode("|",$data[$i]['Goods']);
//    var_dump(sizeof($orderlist[$i]));
//    var_dump($orderlist[$i]);
//    var_dump('<br>');
}
if($user!='') {
    $sql2 = "select * from users where UserName='$user'";
    $result2 = mysqli_query($coon, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
}
//echo sizeof($orderlist);
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
                echo '<p>欢迎您，'.'<a href="userInfo.php"><img class="img-rounded" style="width: 30px;height: 30px;" src="'.$row2['UserImage'].'" title="'.$user.'"></a>'.'<a class="btn btn-danger btn-xs"  href="loginOut.php">退出登录</a>'.'</p>';
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
        <form class="navbar-form navbar-right" method="post" action="orderSearch.php">
            <p style="display: inline;color: white;">当前共有<?php echo mysqli_num_rows($result); ?>条订单信息&nbsp;&nbsp;&nbsp;</p>
            <div class="form-group">
                <input type="text" class="form-control" name="ordersearch" placeholder="请输入订单编号检索信息" />
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <hr>
    <h3>我的订单</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 30%;">宝贝</th>
            <th style="width: 10%;">单价</th>
            <th style="width: 10%;">数量</th>
            <th style="width: 10%;">小计</th>
            <th style="width: 10%;">总价</th>
            <th style="width: 10%;">是否付款</th>
            <th style="width: 20%;">操作</th>
        </tr>
        </thead>
    </table>
    <?php
    for($i=0;$i<sizeof($orderlist);$i++){
    ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="7" style="background-color: #F1F1F1;">
                    <?php echo $data[$i]['OrderTime']?>&nbsp;&nbsp;
                    <span>订单号：&nbsp;&nbsp;</span>
                    <?php echo $data[$i]['OrderId']?>
                </th>
            </tr>
            </thead>
        <?php
    for($j=0;$j<sizeof($orderlist[$i]);$j++){
    $goodlist[$j]=explode(",",$orderlist[$i][$j]);
    //        var_dump($goodlist[$j]);
    //        var_dump('<br>');
    $str=$goodlist[$j][0];
    $sql1="select * from goods where GoodId='$str'";
    $result1=mysqli_query($coon,$sql1);
    $row1=mysqli_fetch_assoc($result1);
//    echo $row1['GoodName'];
//    var_dump('<br>');
    ?>
        <tr>
            <td style="width: 30%;"><?php $imagepath="./".$row1['GoodImage'];$href="goodDetail.php?id=".$row1['GoodId']; echo "<a href='$href'><img class='img-circle' style='width: 50px;height: 50px;' src='$imagepath'></a>";echo "<a style='text-decoration: none;color: black;' href='$href'><span>".$row1['GoodName']."</span></a>";?></td>
            <td style="width: 10%;"><?php if($row2['IsVIP']=='0') $price=$row1['GoodPrice1'];else $price=$row1['GoodPrice2'];echo $price;?></td>
            <td style="width: 10%;"><?php echo $goodlist[$j][1];?></td>
            <td style="width: 10%;"><?php echo $goodlist[$j][1]*$price;?></td>
            <?php
            if($j==0) {
                $str1=($data[$i]['IsPaid']=='0')?"否":"是";
                echo "<td style='width: 10%;' rowspan='0'>".$data[$i]['OrderPrice']."</td>";
                echo "<td style='width: 10%;' rowspan='0'>" . $str1 . "</td>";
                if($str1=='否') {
                    echo "<td style='width: 20%;' rowspan='0'>
                    <a class='btn btn-info' href='orderPay.php?orderId=" . $data[$i]['OrderId'] . "'>支付</a>&nbsp;&nbsp;&nbsp;
                    <a class='btn btn-danger' href='orderDelHandle.php?orderId=" . $data[$i]['OrderId'] . "'>取消订单</a>
                    </td>";
                }
                elseif ($str1=='是') {
                    echo "<td style='width: 20%;' rowspan='0'>
                    <a disabled='disabled' class='btn btn-info' href='orderPay.php?orderId=" . $data[$i]['OrderId'] . "'>支付</a>&nbsp;&nbsp;&nbsp;
                    <a disabled='disabled' class='btn btn-danger' href='orderDelHandle.php?orderId=" . $data[$i]['OrderId'] . "'>取消订单</a>
                    </td>";
                }
            }
            ?>
        </tr>
    <?php
    }
    ?>
    </table>
        <?php
    }
    ?>

</div>
</body>
</html>
