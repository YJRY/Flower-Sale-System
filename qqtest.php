<?php
//session_start();
//class cart_list{
//    public $goodname;
//    public $goodimage;
//    public $goodprice;
//    public $goodnum;
//    function  settype(){
//        settype($this->goodname,'string');
//        settype($this->goodimage,'string');
//        settype($this->goodprice,'float');
//        settype($this->goodnum,'int');
//    }
//}
//function setvalue(&$s1,$s2,$s3,$s4,$s5){
//    $s1->goodname=$s2;
//    $s1->goodimage=$s3;
//    $s1->goodprice=$s4;
//    $s1->goodnum=$s5;
//}
//$test=new cart_list();
//$test->goodname="商品名称11";
//$test->goodimage="商品图片路径";
//$test->goodprice=302.1;
//$test->goodnum=1;
//
//$test2=new cart_list();
//setvalue($test2,"asd",'sgb./a',333.2,2);
//$arr=array();
//$arr[0]=$test;
//$arr[1]=$test2;
//$_SESSION['cartlist1']=$arr;
//print_r('以下是session中的信息：');
//print_r($_SESSION['cartlist1']);
//print_r(sizeof($_SESSION['cartlist1']));
//for($i=0;$i<sizeof($_SESSION['cartlist1']);$i++){
//    print_r('一条一条读商品名称啦！');
//    print_r($_SESSION['cartlist1'][$i]->goodname);
//}
$str=$_POST['sss'];
echo $str;
$str1=$_POST['lll'];
echo $str1;
