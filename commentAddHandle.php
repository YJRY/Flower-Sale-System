<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/17
 * Time: 19:54
 */
include "connectSQL.php";
session_start();
$comment=$_POST['comment'];
$date=date("Y-m-d H:i:s");
$user=$_SESSION['user'];
$goodid=$_POST['goodid'];
if($comment==''){
    echo "<script>alert('你的评论为空！');history.back();</script>";
}
else {
    if(mb_strlen($comment)>255){
        echo "<script>alert('你的评论超出了最大限制长度（255）！请重新输入。');history.back();</script>";
    }
    else {
        $sqlinsert = "insert into comments(Time,GoodId,UserName,Content) values ('$date','$goodid','$user','$comment')";
        if ($result = mysqli_query($coon, $sqlinsert)) {
            echo "<script>alert('添加评论成功！');history.back();</script>";
        } else {
            echo "<script>alert('添加评论失败！');history.back();</script>";
        }
    }
}

