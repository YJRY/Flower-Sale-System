<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/7
 * Time: 22:49
 */
include "connectSQL.php";

$id=$_GET['id'];
$deletesql = "delete from users where UserId=$id";
if(mysqli_query($coon,$deletesql)){
    echo "<script>alert('删除用户成功');window.location.href='userManager.php';</script>";
}else{
    echo "<script>alert('删除用户失败');window.location.href='userManager.php';</script>";
}
