<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/8
 * Time: 12:37
 */
include "connectSQL.php";     //调用数据库连接文件
include "userImageUpload.php";
$IsRegister=0;//确认用户名是否被注册
//接收前台传递过来的post值
$username=$_POST['username'];
$password=$_POST['password'];
$password_c=$_POST['password-confirm'];
$usersex=$_POST['usersex'];
$userage=$_POST['userage'];
$truename=$_POST['truename'];
$useremail=$_POST['useremail'];
$userphone=$_POST['userphone'];
$useraddress=$_POST['useraddress'];
$userpower=$_POST['userpower'];
$consumenum=(($_POST['consumenum']=='')?'0':$_POST['consumenum']);
$isVIP=$_POST['isVIP'];
$date=date("Y-m-d H:i:s");

if($username==""||$truename==""||$password==""||$password_c==""||$userage==""||$userphone==""||$useraddress=="")
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
                $filepath=upload();
                $sqlinsert = "INSERT INTO users(UserName,TrueName,UserPassword,UserSex,UserAge,UserEmail,
              UserPhone,UserAddress,UserImage,UserPower,ConsumeNum,RegisterTime,IsVIP) VALUES('$username','$truename','$password',
              '$usersex','$userage','$useremail','$userphone','$useraddress','$filepath','$userpower','$consumenum','$date','$isVIP')";
                if($result1 = mysqli_query($coon, $sqlinsert)){
                    echo "<script>alert('添加用户成功！');window.location.href='userManager.php';</script>";
                }
                else
                    echo "<script>alert('添加用户失败！请重新输入信息！');history.back();</script>";
            }
        }
    }
}
?>
