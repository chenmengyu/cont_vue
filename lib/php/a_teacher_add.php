<?php
include('db.php');
$uname = $_REQUEST['uname'];
$upwd = "123456";
$role = "2";
$phone = $_REQUEST['phone'];
$age = $_REQUEST['age'];
$sex = $_REQUEST['sex'];
$danwei = $_REQUEST['danwei'];
$xueli = $_REQUEST['xueli'];
$jiao_age = $_REQUEST['jiao_age'];
$email = $_REQUEST['email'];
$sfz = $_REQUEST['sfz'];


$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);


$sql = "INSERT INTO users VALUES(NULL,'$uname','$upwd','$role','$phone','$age','$sex','$danwei','$xueli','$jiao_age','$email','$sfz')";	
$result = mysqli_query($conn,$sql);


if($result === FALSE){
	echo "no：$sql";
}else{
	echo "yes";
}
