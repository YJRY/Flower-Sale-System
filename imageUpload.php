<?php
//$_FILES文件上传变量
function upload(){
    define('ROOT',dirname(__FILE__).'/');
//print_r($_FILES);
    $filename=$_FILES['userimage']['name'];
    $type=$_FILES['userimage']['type'];
    $tmp_name=$_FILES['userimage']['tmp_name'];
    $size=$_FILES['userimage']['size'];
    $error=$_FILES['userimage']['error'];
    $filepath="images/userImages/".$filename;
//echo dirname($tmp_name);
//将服务器上的临时文件移动到指定目录下
//move_upload_file($tmp_name,$destination);将服务器上的临时文件移动
//叫什么名字，移动成功返回true，否则返回false
//判断下错误号，只有0或者是UPLOAD_ERR_OK，没有错误发生，上传成功
    if($error==UPLOAD_ERR_OK){
        if(move_uploaded_file($tmp_name,ROOT."/images/userImages/".$filename)) {
        }
        else {
            echo "上传失败！";
        }
    }
    else{
        switch ($error){
            case 1:
                echo "<script>alert('上传文件超过了PHP配置文件中upload_filesize设置的值！');window.location.href='userAdd.php';</script>";
                break;
            case 2:
                echo "<script>alert('超过了表单MAX_FILE_SIZE限制的大小！');window.location.href='userAdd.php';</script>";
                break;
            case 3:
                echo "<script>alert('文件部分被上传！');window.location.href='userAdd.php';</script>";
                break;
            case 4:
                echo "<script>alert('没有选择上传文件，系统使用默认用户头像~');</script>";
                $filepath="images/userImages/default.jpg";
                break;
            case 6:
                echo "<script>alert('没有找到临时目录！');window.location.href='userAdd.php';</script>";
                break;
            case 7:
            case 8:
                echo "<script>alert('系统错误！');window.location.href='userAdd.php';</script>";
                break;
        }
    }
    return $filepath;
}
//$path=ROOT."../image/userImages/".$filename;
//function turn($string){
//    $result=str_replace("\\","/",$string);
//    return $result;
//}





