<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/10
 * Time: 20:01
 */
include "connectSQL.php";
session_start();
$data=array();
$cartlist=array();
if(!empty($_SESSION['cartlist'])){
    for($i=0;$i<sizeof($_SESSION['cartlist']);$i++){
        $cartlist[$i]=$_SESSION['cartlist'][$i];
    }
}
class good{
    public $goodid;
    public $goodnum;
    function  settype(){
        settype($this->goodid,'int');
        settype($this->goodnum,'int');
    }
}
//echo sizeof($_SESSION['cartlist']);
//echo sizeof($cartlist);
//print_r($cartlist);
for($i=0;$i<sizeof($cartlist);$i++){
    $str=$cartlist[$i]->goodid;
    $sql="select * from goods where GoodId='$str'";
    $result=mysqli_query($coon,$sql);
    $row=mysqli_fetch_assoc($result);
    $data[$i]=$row;
}
//if(!empty($arr)) {
//    foreach ($arr as $value) {
//        echo $value['GoodId'].floatval($value['GoodPrice1']);
//    }
//}
//判断登录用户是否为VIP
$str1=$_SESSION['user'];
$sql1="select * from users where UserName='$str1'";
$result1=mysqli_query($coon,$sql1);
$row1=mysqli_fetch_assoc($result1);
//if (!empty($result1))
//    echo "<script>alert('查询VIP结果不为空.');</script>";
//echo ($row1['IsVIP']+1);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的购物车</title>
    <link rel="icon" type="text/css" href="./images/logo.ico">
    <link rel="stylesheet" href="styles/index-style.css">
    <link rel="stylesheet" href="styles/allset.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/fontawesome-all.css">
    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/cartHandle.js"></script>
    <style>
        span:hover{
            cursor:pointer
        }
    </style>
</head>
<body style="margin: 0 auto;">
<div class="content">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-4" style="margin-top: 30px;">欢迎来到法兰沃鲜花购物网站!
            <?php

            if($_SESSION['user']=="")
                echo "<a class='btn btn-success btn-xs' href='login.php'>登录</a>"."&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-xs'  href='register.php'>注册</a>";
            else {
                echo '<p>欢迎您，'.'<a href="userInfo.php"><img class="img-rounded" style="width: 30px;height: 30px;" src="'.$row1['UserImage'].'" title="'.$str1.'"></a>'.'<a class="btn btn-danger btn-xs"  href="loginOut.php">退出登录</a>'.'</p>';
            }
            ?>
        </div>
        <div class="col-md-5">
            <img src="./images/title-logo.jpg" alt="法兰沃">
        </div>
        <div class="col-md-3" style="margin-top: 30px;padding-left: 150px;">
            <a class="" href="#" style="font-size: 15px;text-decoration: none;color: black;">查看购物车
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
            <div class="form-group">
                <input type="text" class="form-control" name="goodsearch" placeholder="请输入商品名检索信息" />
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <form role="form" action="calculate.php" method="post">
        <table id="cartTable" class="table  table-hover">
            <thead>
            <tr>
                <th style='width: 10%;'><label><input class="check-all check" type="checkbox">全选</label></th>
                <th style='width: 20%;'>商品信息</th>
                <th style='width: 20%;'>商品单价</th>
                <th style='width: 20%;'>商品数量</th>
                <th style='width: 10%;'>金额</th>
                <th style="width: 10%;">操作</th>
            </tr>
            </thead>
            <tbody style="font-size: 6px;">
            <?php
            if(!empty($data)) {
                $j=0;
                $k=0;
                foreach ($data as $value) {
                    ?>
                    <tr style="height: 80px;">
                        <td style="line-height: 80px;"><input class="check-one check" type="checkbox" name="select[]" value="<?php echo ($value['GoodId']);?>"></td>
                        <td style="line-height: 80px;"><?php $imagepath="./".$value['GoodImage']; echo "<img class='img-circle' style='width: 60px;height: 60px;' src='$imagepath'>";echo $value['GoodName'];?></td>
                        <td class="price" style="line-height: 90px;">
                            <?php
                            if($row1['IsVIP']==0)
                                echo $value['GoodPrice1'];
                            else
                                echo $value['GoodPrice2'];
                            ?></td>
                        <td class="count" style="line-height: 80px;">
                            <span class="reduce" style="font-size: 15px;">-</span>
                            <input class="count-input" type="text" style="width: 60px;height: 30px;" name="num[]" value="<?php echo $cartlist[$j]->goodnum;$j++;?>">
                            <span class="add" style="font-size: 15px;">+</span>
                        </td>
                        <td class="subtotal" style="line-height: 80px; color: #ff4400;">
                            <?php
                            $price=($row1['IsVIP']==0)?$value['GoodPrice1']:$value['GoodPrice2'];
                            echo $cartlist[$k]->goodnum*$price;$k++; ?></td>
                        <td class="operation" style="line-height: 80px;">
                            <span class="delete">删除</span>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
                echo "<tr><td colspan='6'><h3>购物车里空空如也。。。</h3></td></tr>";
            ?>
            </tbody>
        </table>
        <input class="btn" type="submit" style="background-color: #F22D00;color: white;float: right;width: 100px;height: 35px;" id="calculate" value="结算">
    </form>
    <div class="foot" id="foot" style="background-color: #E5E5E5;height: 35px;">
        <label class="select-all"><input class="check-all check" type="checkbox">全选&nbsp;&nbsp;</label>
        <span class="delete" id="deleteAll">删除</span>
        <div class="total" style="float: right;margin-right: 20px;line-height: 35px;">合计（不含运费）：￥<span id="priceTotal" style="color: #ff4400;">0.00</span></div>
        <div class="selected" id="selected" style="float: right;margin-right: 20px;line-height: 35px;">已选商品<span id="selectedTotal" style="color: #ff4400;">0</span>件</div>





    </div>
</div>
</body>
</html>