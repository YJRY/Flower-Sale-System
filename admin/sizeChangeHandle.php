<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/27
 * Time: 18:17
 */
include "connectSQL.php";
$id=$_GET['id'];
$hmgnum=($_POST['hmgnum']=='')?'0':$_POST['hmgnum'];
$mtxnum=($_POST['mtxnum']=='')?'0':$_POST['mtxnum'];
$bhnum=($_POST['bhnum']=='')?'0':$_POST['bhnum'];
$zmgnum=($_POST['zmgnum']=='')?'0':$_POST['zmgnum'];
$lmgnum=($_POST['lmgnum']=='')?'0':$_POST['lmgnum'];
$yjxnum=($_POST['yjxnum']=='')?'0':$_POST['yjxnum'];
$bmgnum=($_POST['bmgnum']=='')?'0':$_POST['bmgnum'];
$knxnum=($_POST['knxnum']=='')?'0':$_POST['knxnum'];
$xrknum=($_POST['xrknum']=='')?'0':$_POST['xrknum'];
$mlynum=($_POST['mlynum']=='')?'0':$_POST['mlynum'];
$updatesql = "update goodsizes set 红玫瑰='$hmgnum',满天星='$mtxnum',百合='$bhnum',紫玫瑰='$zmgnum',蓝玫瑰='$lmgnum',
 郁金香='$yjxnum',白玫瑰='$bmgnum',康乃馨='$knxnum',向日葵='$xrknum',玛利亚='$mlynum' where SizeId=$id";
if($hmgnum=='0'&&$bhnum=='0'&&$mtxnum=='0'&&$zmgnum=='0'&&$lmgnum=='0'&&$yjxnum=='0'&&$bmgnum=='0'&&$knxnum=='0'&&$xrknum=='0'&&$mlynum=='0')
    echo "<script>alert('没有填写任何规格信息，请重新核实！');history.back();</script>";
else {
    if (mysqli_query($coon, $updatesql)) {
        if(mysqli_affected_rows($coon)) {
            echo "<script>alert('修改规格信息成功');window.location.href='sizeManager.php';</script>";
        }
        else
            echo "<script>alert('该规格信息没有作更改！');window.location.href='sizeManager.php';</script>";
    }
    else {
        echo "<script>alert('修改规格信息失败');window.location.href='sizeManager.php';</script>";
    }
}