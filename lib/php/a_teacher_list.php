<?php
include('db.php');
header('Content-Type:application/json');

$conn = mysqli_connect("$host","$name","$pwd","$dbname","$port");

//设置后续SQL语句的编码方式
$sql = "SET NAMES UTF8";
mysqli_query($conn, $sql);

$sql = "SELECT * FROM users WHERE uname<>'admin'";
$result = mysqli_query($conn,$sql);

$userList = [];
while($user = mysqli_fetch_assoc($result)){
	$userList[] = $user;
}
//var_dump($userList);

echo json_encode($userList);
