<?php
date_default_timezone_set("Asia/Seoul");
$servername = "localhost";
$username = "root";
$password = "123456";
$dbflag = "NO";

//1. Create connection mysql -u root -p 123456 localhost
$conn = mysqli_connect($servername, $username, $password);
if(!$conn){die("Connection failed: ". mysqli_connect_error());}

$sql = "show databases";
$result =mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn));
while($row = mysqli_fetch_row($result)){
  if($row[0]==='santteut'){
    $dbflag="OK";
    break;
  }//end of if
}//end of while

if($dbflag==="NO"){
  $sql = "CREATE database `santteut`;";
  if(mysqli_query($conn, $sql)){
    echo "<script>alert('santteut database 생성완료');</script>";
  }else{
    echo "database 생성 실패! 원인 : ".mysqli_error($conn);
  }
}

//2. database 선택 use php_db
$dbconn = mysqli_select_db($conn, "santteut") or die('Error: '.mysqli_error($conn));

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function alert_back($message) {
    echo "<script>alert('$message'); history.go(-1);</script>";
    exit;
}
?>
