<?php
include('db.php');
$uname = $_REQUEST['uname'];
$phone = $_REQUEST['phone'];
$age = $_REQUEST['age'];
$sex = $_REQUEST['sex'];
$danwei = $_REQUEST['danwei'];
$xueli = $_REQUEST['xueli'];
$jiao_age = $_REQUEST['jiao_age'];
$email = $_REQUEST['email'];
$sfz = $_REQUEST['sfz'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql="SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "UPDATE users SET phone='$phone',age='$age',sex='$sex',danwei='$danwei',xueli='$xueli',jiao_age='$jiao_age',email='$email',sfz='$sfz' WHERE uname='$uname'";
//echo $sql;
$result = mysqli_query($conn,$sql);

//phone=&age=0&sex=%E7%94%B7&danwei=&xueli=%E9%AB%98%E4%B8%AD&jiao_age=0&email=&sfz=

if($result === FALSE){
	echo 'no';
}else{
	echo 'yes';
}