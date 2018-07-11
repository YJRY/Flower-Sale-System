<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/8
 * Time: 13:42
 */
include "connectSQL.php";
include "goodImageUpload.php";
$id=$_GET['id'];
$goodname=$_POST['goodname'];
$goodsummary=$_POST['goodsummary'];
$goodprice1=$_POST['goodprice1'];
$goodprice2=$_POST['goodprice2'];
$goodnumber=$_POST['goodnumber'];
$soldnumber=$_POST['soldnumber'];
$goodsize=$_POST['goodsize'];
$goodmessage=$_POST['goodmessage'];
$date=date("Y-m-d H:i:s");
$filepath = upload();
$IsRegister=0;
$updatesql = "update goods set GoodName='$goodname',GoodSummary='$goodsummary',GoodPrice1='$goodprice1',GoodPrice2='$goodprice2',
GoodNumber='$goodnumber',SoldNumber='$soldnumber',GoodSize='$goodsize',GoodMessage='$goodmessage',GoodImage='$filepath' where GoodId=$id";
$updatetime="update goods set UpdateTime='$date' where GoodId=$id";

if($goodname==''||$goodsummary==''||$goodprice1==''||$goodprice2==''||$goodmessage==''||$goodnumber==''||$soldnumber==''||$goodsize=='')
    echo "<script>alert('商品填写信息不完整，请重新核实！');history.back();</script>";
else {
    if($result=mysqli_query($coon,"select * from goods where GoodId=$id")){
        $row=mysqli_fetch_assoc($result);
        if($row['GoodName']==$goodname){
            if (mysqli_query($coon, $updatesql)) {
                if(mysqli_affected_rows($coon)) {
                    mysqli_query($coon,$updatetime);
                    echo "<script>alert('修改商品信息成功');window.location.href='goodManager.php';</script>";
                }
                else
                    echo "<script>alert('该商品信息没有作更改！');window.location.href='goodManager.php';</script>";
            }
            else {
                echo "<script>alert('修改商品信息失败');window.location.href='goodManager.php';</script>";
            }
        }
        else{
            if ($result = mysqli_query($coon, 'SELECT * FROM goods')) {//读取数据
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['GoodName'] == $goodname) {
                        $IsRegister = 1;
                    }
                }
                if ($IsRegister != 0) {//用户名重复
                    echo "<script>alert('商品名已存在！请重新输入');history.back();</script><br>";
                }
                else {//用户名不存在，可以创建!
                    if (mysqli_query($coon, $updatesql)) {
                        if(mysqli_affected_rows($coon)) {
                            mysqli_query($coon,$updatetime);
                            echo "<script>alert('修改商品信息成功');window.location.href='goodManager.php';</script>";
                        }
                        else
                            echo "<script>alert('该商品信息没有作更改！');window.location.href='goodManager.php';</script>";
                    }
                    else {
                        echo "<script>alert('修改商品信息失败');window.location.href='goodManager.php';</script>";
                    }
                }
            }
        }

    }
}
