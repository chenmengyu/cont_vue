<?php
include('db.php');
$uname = $_REQUEST['uname'];
$apwd = $_REQUEST['apwd'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "UPDATE users SET upwd=$apwd WHERE uname='$uname'";
$result = mysqli_query($conn,$sql);

if($result === FALSE){
	echo "sqlError：$sql";
}else{
	echo "yes";
}