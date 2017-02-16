<?php
include('db.php');
header("Content-Type:application/json");

$curPage = $_REQUEST['curPage'];
$uname = $_REQUEST['uname'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

//输出内容
$output = $output = [
	'total'=>0,
	'pageSize'=>10,
	'pageCount'=>0,
	'curPage'=>intval($curPage),
	'data'=>[]
];

//总数
$sql = "SELECT COUNT(*) FROM t_xd_xk WHERE tid<>1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$output['total'] = $row['COUNT(*)'];
//总页数
$output['pageCount'] = ceil($output['total']/$output['pageSize']);

//查询的限制条件
$start = ($output['curPage']-1)*$output['pageSize'];
$count = $output['pageSize'];

$sql = "SELECT u.*,xd.xdname,xk.xkname FROM users as u,xueduan as xd,xueke as xk,t_xd_xk as r WHERE u.uname<>'$uname' AND u.id=r.tid AND r.xdid=xd.id AND r.xkid=xk.id  LIMIT $start,$count";
//echo $sql;
$result = mysqli_query($conn,$sql);
$list = [];
while($row = mysqli_fetch_assoc($result)){
	$list[] = $row;
}
$output['data'] = $list;
//var_dump($output);
echo json_encode($output);