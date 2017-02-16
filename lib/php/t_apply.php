<?php
include('db.php');
header('Content-Type: text/plain');

$uname = $_REQUEST['uname'];
$xdid = $_REQUEST['xdid'];
$xkid = $_REQUEST['xkid'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

//获取当前用户的教师编号
$sql2 = "SELECT id FROM users WHERE uname='$uname'";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($result2);
$tid = $row2['id'];
//echo $tid;

//判断当前用户是否已经报名过课程
$sql3 = "SELECT id FROM t_xd_xk WHERE tid=$tid";
$result3 = mysqli_query($conn,$sql3);
//$row3 = mysqli_fetch_assoc($result3);
//var_dump($row3);
if($row3 = mysqli_fetch_assoc($result3)){
	echo "have";
}else{
	//如果当前用户没有报名过课程
	//将报名结果插入数据库中
	$sql4 = "INSERT INTO t_xd_xk VALUES(NULL,$tid,$xdid,$xkid)";
	$result4 = mysqli_query($conn,$sql4);
	if($result4 === FALSE){
		echo "no";
	}else{
		echo "yes";
	}
}