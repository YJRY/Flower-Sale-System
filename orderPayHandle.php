<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/28
 * Time: 22:19
 */
include "connectSQL.php";
session_start();
$ispaid=$_GET['ispaid'];
$orderid=$_GET['orderid'];
$user=$_SESSION['user'];
$sql5="select * from users where UserName='$user'";
$result5=mysqli_query($coon,$sql5);
$row5=mysqli_fetch_assoc($result5);
$sql1="update orders set IsPaid='1' where OrderId='$orderid'";
$result1=mysqli_query($coon,$sql1);
$sql="select * from orders where OrderId='$orderid'";
$result=mysqli_query($coon,$sql);
$orderlist=array();
$goodlist=array();
$row = mysqli_fetch_assoc($result);
$data[]=$row;
$price=$row['OrderPrice'];

for($i=0;$i<sizeof($data);$i++) {
    $orderlist[$i]=explode("|",$data[$i]['Goods']);
}
for($i=0;$i<sizeof($orderlist);$i++){
    for($j=0;$j<sizeof($orderlist[$i]);$j++){
        $goodlist[$j]=explode(",",$orderlist[$i][$j]);
        $str=$goodlist[$j][0];
        $str2=$goodlist[$j][1];
        $sql2="update goods set GoodNumber=(GoodNumber-$str2),SoldNumber=(SoldNumber+$str2) where GoodId='$str'";
        mysqli_query($coon,$sql2);
        $sqlsize="select GoodSize from goods where GoodId='$str'";
        $resultsize=mysqli_query($coon,$sqlsize);
        $rowsize=mysqli_fetch_assoc($resultsize);
        $size=$rowsize['GoodSize'];
        $sqlsize1="select * from goodsizes where SizeId='$size'";
        $resultsize1=mysqli_query($coon,$sqlsize1);
        $rowsize1=mysqli_fetch_assoc($resultsize1);
        if($rowsize1['红玫瑰']!=0){
            $str='红玫瑰';
            $num=$rowsize1['红玫瑰']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+4*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['满天星']!=0){
            $str='满天星';
            $num=$rowsize1['满天星']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+5*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['百合']!=0){
            $str='红玫瑰';
            $num=$rowsize1['红玫瑰']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+10*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['紫玫瑰']!=0){
            $str='紫玫瑰';
            $num=$rowsize1['紫玫瑰']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+10*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['蓝玫瑰']!=0){
            $str='蓝玫瑰';
            $num=$rowsize1['蓝玫瑰']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+5*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['郁金香']!=0){
            $str='郁金香';
            $num=$rowsize1['郁金香']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+4*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['白玫瑰']!=0){
            $str='白玫瑰';
            $num=$rowsize1['白玫瑰']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+4*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['向日葵']!=0){
            $str='向日葵';
            $num=$rowsize1['向日葵']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+5*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['康乃馨']!=0){
            $str='康乃馨';
            $num=$rowsize1['康乃馨']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+2*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
        if($rowsize1['玛利亚']!=0){
            $str='玛利亚';
            $num=$rowsize1['玛利亚']*$str2;
            $sqlupdate="update flowers set FlowerNumber=(FlowerNumber-$num),SoldNumber=(SoldNumber+$num),SoldProfit=(SoldProfit+5*$num) where FlowerName='$str'";
            mysqli_query($coon,$sqlupdate);
        }
    }
}
$sql3="update users set ConsumeNum=(ConsumeNum+$price) where UserName='$user'";
mysqli_query($coon,$sql3);
$sql4="update users set IsVIP='1' where UserName='$user'";
if ($row5['ConsumeNum']>=10000) {
    mysqli_query($coon, $sql4);
    if(mysqli_affected_rows($coon)){
        echo "<script>alert('您的消费金额已达到10000元以上，恭喜您成为VIP用户！');</script>";
    }
}
if($ispaid=='1') {
    echo "<script>alert('订单支付成功！即将跳转到网站首页。。。');window.location.href='index.php';</script>";
}