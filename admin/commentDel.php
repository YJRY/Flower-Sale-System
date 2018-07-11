<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/17
 * Time: 21:36
 */
$id=$_GET['id'];
include "connectSQL.php";
$deletesql="delete from comments where GoodId='$id'";
if(mysqli_query($coon,$deletesql)){
    echo "<script>alert('删除评论成功');window.location.href='commentManager.php';</script>";
}else{
    echo "<script>alert('删除评论失败');window.location.href='commentManager.php';</script>";
}