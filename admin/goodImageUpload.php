<?php
/**
 * Created by PhpStorm.
 * User: yjry
 * Date: 2018/4/8
 * Time: 16:54
 */
//$_FILES文件上传变量
function upload()
{
    define('ROOT', dirname(__FILE__) . '/');
//print_r($_FILES);
    $filename = $_FILES['goodimage']['name'];
    $type = $_FILES['goodimage']['type'];
    $tmp_name = $_FILES['goodimage']['tmp_name'];
    $size = $_FILES['goodimage']['size'];
    $error = $_FILES['goodimage']['error'];
    $filepath = "images/goodImages/" . $filename;

    if ($error == UPLOAD_ERR_OK) {
        if (move_uploaded_file($tmp_name, ROOT . "../images/goodImages/" . $filename)) {

        } else {
            echo "上传失败！";
        }
    } else {
        switch ($error) {
            case 1:
                echo "<script>alert('上传文件超过了PHP配置文件中upload_filesize设置的值！');window.location.href='goodManager.php';</script>";
                break;
            case 2:
                echo "<script>alert('超过了表单MAX_FILE_SIZE限制的大小！');window.location.href='goodManager.php';</script>";
                break;
            case 3:
                echo "<script>alert('文件部分被上传！');window.location.href='goodManager.php';</script>";
                break;
            case 4:
                echo "<script>alert('没有选择上传图片！系统使用默认商品图片。。。');</script>";
                $filepath = "images/goodImages/default.jpg";
                break;
            case 6:
                echo "<script>alert('没有找到临时目录！');window.location.href='goodManager.php';</script>";
                break;
            case 7:
            case 8:
                echo "<script>alert('系统错误！');window.location.href='goodManager.php';</script>";
                break;
        }
    }
    return $filepath;
}