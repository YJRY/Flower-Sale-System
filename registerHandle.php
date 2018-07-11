<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/3/19
 * Time: 21:29
 * * 此文件为注册后台
 */
header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8 //屏蔽错误信息
include 'connectSQL.php';     //调用数据库连接文件
$IsRegister=0;//确认用户名是否被注册
//接收前台传递过来的post值
$username=$_POST['username'];
$password=$_POST['password'];
$password_c=$_POST['password-confirm'];
$usersex=$_POST['usersex'];
$userage=$_POST['userage'];
$useremail=$_POST['useremail'];
$truename=$_POST['truename'];
$userphone=$_POST['userphone'];
$useraddress=$_POST['useraddress'];
$date=date("Y-m-d H:i:s");
session_start();
if($username==""||$password==""||$password_c==""||$userage==""||$userphone=="")
    echo "<script>alert('您的信息填写不完整，请重新核实！');history.back();</script>";
else {
    if($password!=$password_c)
        echo "<script>alert('您输入的两次密码不一致，请重新输入！');history.back();</script>";
    else {
        if ($result = mysqli_query($coon, 'SELECT * FROM users')) {//读取数据
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['UserName'] == $username) {
                    $IsRegister = 1;
                }
            }
            if ($IsRegister != 0) {//用户名重复
                echo '<script>alert("用户名已存在！请重新输入");history.back();</script><br>';
            }
            else{//用户名不存在，可以创建!
                //执行插入语句
                $sqlinsert = "INSERT INTO users(UserName,TrueName,UserPassword,UserSex,UserAge,UserEmail,
UserPhone,UserAddress,UserImage,UserPower,RegisterTime,ConsumeNum,IsVIP) VALUES('$username','$truename','$password','$usersex','$userage','$useremail','$userphone','$useraddress','images/userImages/default.jpg',0,'$date',0,0)";
                $result1 = mysqli_query($coon, $sqlinsert);
                if($result1!=false) {
                    echo "<script>alert('注册成功！');window.location.href='index.php';</script>";
                }
                else
                    echo "<script>alert('注册失败！请重新输入信息！');history.back();</script>";
            }
        }
    }
}
//提示跳转到主页面