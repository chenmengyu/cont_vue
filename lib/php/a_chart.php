<?php
include('db.php');
header('Content-Type:application/json;charset=utf-8');

$tname = $_REQUEST['tname'];

//判断查询哪个表
if($tname == 'xueduan'){
  $xname = 'xdname';
  $id = 'xdid';
}else{
  $xname = 'xkname';
  $id = 'xkid';
}

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

//TODO 总数
$sql = "SELECT COUNT(*) FROM $tname";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$total = $row['COUNT(*)'];
//echo $total;

//输出的数据
/*
$output = [
    'label'=>[],
    'value'=>[],
];
*/
for($i=0;$i<$total;$i++){
   $sql = "SELECT id,$xname FROM $tname LIMIT $i,1";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  //var_dump($row);
  $output['label'][] = $row["$xname"];

  $x = intval($row['id']);
   $sql = "SELECT COUNT(*) FROM t_xd_xk WHERE $id=$x";
  //echo $sql;
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $output['value'][] = $row['COUNT(*)'];
}
echo json_encode($output);
?>