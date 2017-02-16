<?php
include('db.php');
header('Content-Type:text/html');

$uname = $_REQUEST['uname'];

$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "DELETE FROM t_xd_xk WHERE tid=(SELECT id FROM users WHERE uname=$uname)";
//echo $sql;
$result = mysqli_query($conn,$sql);
if($result === FALSE){
	echo "no";
}else{
	echo "yes";
}