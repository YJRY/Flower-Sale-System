<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/25
 * Time: 18:51
 */
include "connectSQL.php";
session_start();
$arr=array();
$arr=$_POST['select'];
$arr1=$_POST['num'];
$address=$_POST['address'];
$sumprice=$_POST['sumprice'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$words=$_POST['words'];
$user=$_SESSION['user'];
$goods="";
$ordertime=date("Y-m-d H:i:s");
$sql="select * from users where UserName='$user'";
$result=mysqli_query($coon,$sql);
$row=mysqli_fetch_assoc($result);
//echo $address;
//if(empty($sumprice))
//    echo "总价为空.";
//else
//    echo $sumprice;
//if(empty($arr)||empty($arr1))
//    echo "为空？？？";
//else{
//    for($i=0;$i<sizeof($arr);$i++){
//        echo $arr[$i].",".$arr1[$i];
//    }
//}
//将商品ID和商品数量合并到一起，存放到新数组中
function composeGoods($str1,$str2){
    $goods=array();
    $lastgoods="";
    for($i=0;$i<sizeof($str1);$i++){
        $goods[$i]=$str1[$i].",".$str2[$i];
    }
    for($i=0;$i<sizeof($str1);$i++){
        if($i==sizeof($str1)-1)
            $lastgoods.=$goods[$i];
        else
            $lastgoods.=($goods[$i]."|");
    }
    return $lastgoods;
}
$goods=composeGoods($arr,$arr1);
//echo $goods;
//for($i=0;$i<sizeof($goods);$i++){
//    echo $goods[$i];
//}
if($address==''||$name==''||$phone=='')
    echo "<script>alert('您的信息填写不完整，请重新核实！');window.location.href='shoppingCart.php';</script>";
else {
    if(mb_strlen($words)>=255){
        echo "<script>alert('你的留言超出了最大限制长度（255）！请重新输入。');window.location.href='shoppingCart.php';</script>";
    }
    else {
        $sql = "insert into orders(OrderTime, Goods, UserName, ReceiveName, Phone, Address, Words, OrderPrice, IsPaid) 
values ('$ordertime','$goods','$user','$name','$phone','$address','$words','$sumprice','0')";
        $result1 = mysqli_query($coon, $sql);
        if ($result1 != false) {
            unset($_SESSION['cartlist']);
            echo "<script>alert('提交订单成功！');</script>";
        } else
            echo "<script>alert('订单提交失败！');history.back();</script>";
    }
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
                echo '<p>欢迎您，'.'<a href="userInfo.php"><img class="img-rounded" style="width: 30px;height: 30px;" src="'.$row['UserImage'].'" title="'.$user.'"></a>'.'<a class="btn btn-danger btn-xs"  href="loginOut.php">退出登录</a>'.'</p>';
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
    <hr>
    <h1>提交订单成功！</h1><a href="orderShow.php">查看订单</a>
</div>
</body>
</html>


