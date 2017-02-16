<?php
include('db.php');
header("Content-Type: application/json");
$tname = $_REQUEST['tname'];
$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "SELECT * FROM $tname";
$result = mysqli_query($conn,$sql);

$output = [];
while($row = mysqli_fetch_assoc($result)){
	$output[] = $row;
}
//var_dump($output);
echo json_encode($output);