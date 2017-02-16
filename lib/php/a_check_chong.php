<?php
include('db.php');

$uname = $_REQUEST['uname'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "SELECT * FROM users WHERE uname='$uname'";
$result = mysqli_query($conn,$sql);
//echo $sql;

if(mysqli_fetch_assoc($result) === null){
	echo "no";
}else{
	echo "yes";
}