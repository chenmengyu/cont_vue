<?php
include('db.php');
$uname = $_REQUEST['uname'];

//$conn = mysqli_connect($host,$name,$pwd,$dbname,$port);
$conn = mysqli_connect('localhost','root','','conteducation',3306);

$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

$sql = "SELECT * FROM users WHERE uname='$uname'";
$result = mysqli_query($conn,$sql);

$output = mysqli_fetch_assoc($result);
//var_dump($output);
echo json_encode($output);