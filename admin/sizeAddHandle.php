<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/5/27
 * Time: 18:17
 */
include "connectSQL.php";     //调用数据库连接文件
//接收前台传递过来的post值
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

if($hmgnum=='0'&&$bhnum=='0'&&$mtxnum=='0'&&$zmgnum=='0'&&$lmgnum=='0'&&$yjxnum=='0'&&$bmgnum=='0'&&$knxnum=='0'&&$xrknum=='0'&&$mlynum=='0')
    echo "<script>alert('没有填写任何规格信息，请重新核实！');history.back();</script>";
else {
    //执行插入语句
    $sqlinsert = "INSERT INTO goodsizes(红玫瑰,满天星,百合,紫玫瑰,蓝玫瑰,郁金香,白玫瑰,向日葵,康乃馨,玛利亚) 
    VALUES('$hmgnum','$mtxnum','$bhnum','$zmgnum','$lmgnum','$yjxnum','$bmgnum','$xrknum','$knxnum','$mlynum')";
    if ($result1 = mysqli_query($coon, $sqlinsert)) {
        echo "<script>alert('添加规格成功！');window.location.href='sizeManager.php';</script>";
        } else
            echo "<script>alert('添加规格失败！请重新输入信息！');history.back();</script>";
}

