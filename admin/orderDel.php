<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/10
 * Time: 18:39
 */
include "connectSQL.php";
$id=$_GET['id'];
$deletesql = "delete from orders where OrderId=$id";
if(mysqli_query($coon,$deletesql)){
    echo "<script>alert('删除订单成功');window.location.href='orderManager.php';</script>";
}else{
    echo "<script>alert('删除订单失败');window.location.href='orderManager.php';</script>";
}