<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/7
 * Time: 23:40
 */
include "connectSQL.php";
include "userImageUpload.php";
$id=$_GET['id'];
$username=$_POST['username'];
$password=$_POST['password'];
$password_c=$_POST['password-confirm'];
$usersex=$_POST['usersex'];
$truename=$_POST['truename'];
$userage=$_POST['userage'];
$useremail=$_POST['useremail'];
$userphone=$_POST['userphone'];
$useraddress=$_POST['useraddress'];
$userpower=$_POST['userpower'];
$consumenum=$_POST['consumenum'];
$isVIP=$_POST['isVIP'];
$filepath = upload();
$IsRegister=0;
$updatesql = "update users set UserName='$username',TrueName='$truename',UserPassword='$password',UserSex='$usersex',UserAge='$userage',UserEmail='$useremail',UserPhone='$userphone',UserAddress='$useraddress',
 UserPower='$userpower',ConsumeNum='$consumenum',IsVIP='$isVIP',UserImage='$filepath' where UserId=$id";

if($username==""||$truename==""||$password==""||$password_c==""||$userage==""||$userphone==""||$useraddress==""||$userpower==""||$isVIP=="")
    echo "<script>alert('用户信息填写不完整，请重新核实！');history.back();</script>";
else {
    if ($password != $password_c)
        echo "<script>alert('您输入的两次密码不一致，请重新输入！');history.back();</script>";
    else {
        if ($result = mysqli_query($coon, "select * from users where UserId=$id")) {
            $row = mysqli_fetch_assoc($result);
            if ($row['UserName'] == $username) {
                if (mysqli_query($coon, $updatesql)) {
                    if(mysqli_affected_rows($coon))
                        echo "<script>alert('修改用户信息成功');window.location.href='userManager.php';</script>";
                    else
                        echo "<script>alert('该用户信息没有作更改！');window.location.href='userManager.php';</script>";
                }
                else {
                    echo "<script>alert('修改用户信息失败');window.location.href='userManager.php';</script>";
                }
            }
            else {
                if ($result = mysqli_query($coon, 'SELECT * FROM users')) {//读取数据
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['UserName'] == $username) {
                            $IsRegister = 1;
                        }
                    }
                    if ($IsRegister != 0) {//用户名重复
                        echo "<script>alert('用户名已存在！请重新输入');history.back();</script><br>";
                    }
                    else {//用户名不存在，可以创建!
                        if (mysqli_query($coon, $updatesql)) {
                                echo "<script>alert('修改用户信息成功');window.location.href='userManager.php';</script>";
                        }
                        else {
                            echo "<script>alert('修改用户信息失败');window.location.href='userManager.php';</script>";
                    }
                }
            }
        }
        }
    }

}
