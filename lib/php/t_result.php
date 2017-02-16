<?php
include('db.php');
header('Content-Type: application/json');

$uname = $_REQUEST['uname'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

//查询当前用户的编号
/*$sql2 = "SELECT id FROM users WHERE uname=$uname";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($result2);
$tid = $row2['id'];

//查询当前用户报名结果的编号
$sql3 = "SELECT id FROM t_xd_xk WHERE tid=$tid";
$result3 = mysqli_query($conn,$sql3);
echo $sql3;
if($row3 = mysqli_fetch_assoc($result3)){
	$rid = $row3['id'];
	$sql4 = "SELECT xd.xdname,xk.xkname FROM xueduan as xd,xueke as xk,t_xd_xk as r WHERE r.id=$rid AND r.xdid=xd.id AND r.xkid=xk.id";
	$result4 = mysqli_query($conn,$sql4);
	if($row4 = mysqli_fetch_assoc($result4)){
		echo json_encode($row4);
	}else{
		echo "no";
	}
}else{
	echo "no";
	return;
}*/

$sql = "SELECT u.*,xd.xdname,xk.xkname FROM users as u,xueduan as xd,xueke as xk,t_xd_xk as r WHERE u.uname=‘$uname’ AND u.id=r.tid AND r.xdid=xd.id AND r.xkid=xk.id";
$result = mysqli_query($conn,$sql);
if($result === FALSE){
	echo "no";
}else{
	$row = mysqli_fetch_assoc($result);
	echo json_encode($row);
}
