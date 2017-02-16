<?php
include('db.php');

$uname = $_REQUEST['name'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "DELETE FROM users WHERE uname='$uname'";
$result = mysqli_query($conn,$sql);

if($result === FALSE){
	echo "no";
}else{
	echo "yes";
}