<?php
date_default_timezone_set("Asia/Seoul");

// $servername = "localhost";
// $username = "root";
// $password = "123456";
$servername = "192.168.0.58";
$username = "santteut";
$password = "!@#$%^123456";
// 1 .Create connection mysql -u root -p 123456 -h 192.168.0.230
$conn = mysqli_connect($servername, $username, $password);
if (!$conn){ die("Connection failed: " . mysqli_connect_error());}


$sql = "show databases";
$result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

while ($row=mysqli_fetch_row($result)) {
  if($row[0] ==='santteut'){
    $dbflag="OK";
    break;
  }
}

if($dbflag==="NO"){
  $sql = "create database santteut";

  if(mysqli_query($conn,$sql)){
    echo "<script>alert('santteut 디비 생성되었습니다.');</script> ";
  }else{
    echo "실패원인".mysqli_error($conn);
  }
}

//2. 데이타 베이스 선택 use kdhong_db
$dbconn = mysqli_select_db($conn,"santteut") or die('Error: '.mysqli_error($conn));


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function alert_back($data) {
  echo "<script>alert('$data');history.go(-1);</script>";
  exit;
}
?>
