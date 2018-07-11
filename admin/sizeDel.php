<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/27
 * Time: 18:17
 */
include "connectSQL.php";
$id=$_GET['id'];
$deletesql = "delete from goodsizes where SizeId=$id";
if(mysqli_query($coon,$deletesql)){
    echo "<script>alert('删除规格成功');window.location.href='sizeManager.php';</script>";
}else{
    echo "<script>alert('删除规格失败');window.location.href='sizeManager.php';</script>";
}