<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/10
 * Time: 19:19
 */
include "connectSQL.php";
$id=$_GET['id'];
$goods=$_POST['goods'];
$username=$_POST['username'];
$receivename=$_POST['receivename'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$words=$_POST['words'];
$ispaid=$_POST['ispaid'];
$IsRegister=0;
$updatesql = "update orders set goods='$goods',UserName='$username',ReceiveName='$receivename',
Phone='$phone',Address='$address',Words='$words',IsPaid='$ispaid' where OrderId=$id";

if($goods==""||$username==''||$receivename==""||$phone==""||$phone==""||$address==""||$ispaid=="")
    echo "<script>alert('订单信息填写不完整，请重新核实！');history.back();</script>";
else {
    if ($result = mysqli_query($coon, "select * from orders where OrderId=$id")) {
        $row = mysqli_fetch_assoc($result);
        if (mysqli_query($coon, $updatesql)) {
            if(mysqli_affected_rows($coon))
                echo "<script>alert('修改订单信息成功');window.location.href='orderManager.php';</script>";
            else
                echo "<script>alert('该订单信息没有作更改！');window.location.href='orderManager.php';</script>";
        }
        else {
            echo "<script>alert('修改订单信息失败');window.location.href='orderManager.php';</script>";
        }
    }
}