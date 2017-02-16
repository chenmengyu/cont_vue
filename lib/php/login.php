<?php
include('db.php');
$uname = $_REQUEST['uname'];
$upwd = $_REQUEST['upwd'];
$role = $_REQUEST['role'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "SELECT role FROM users WHERE uname='$uname' AND upwd='$upwd'";
//echo $sql;
$result = mysqli_query($conn,$sql);

$r = mysqli_fetch_assoc($result);
//var_dump($r);
//echo $r['role'];
if($role == $r['role'] && $result != FALSE){
	if($r['role'] == 1){
		echo 'admin';
	}else{
		echo 'teacher';
	}
}else{
	echo "no";
}
