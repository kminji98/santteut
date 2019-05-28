<?php
date_default_timezone_set("Asia/Seoul");
$servername = "localhost";
$username = "root";
$password = "123456";
$dbflag ="NO";
$flag2 ="NO";
$flag ="NO";
$conn = mysqli_connect($servername, $username, $password);
$sql = "show databases";
$result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));
while ($row=mysqli_fetch_row($result)) {
  if($row[0] ==='free'){
    $dbflag ="OK";
    break;
  }
}
if($dbflag==="NO"){
  $sql = "create database free";
    if(mysqli_query($conn,$sql)){
      echo "<script>alert('free 디비 생성되었습니다.');</script> ";}
      else{echo "<script>alert('디비 생성 에러');</script> ";}}

mysqli_select_db($conn,"free") or die('Error: '.mysqli_error($conn));


    $sql = "show tables from free";
    $result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));
    while ($row=mysqli_fetch_row($result)) {
      if($row[0] === "free"){
      $flag ="OK";
      break;
      }
      }
    while ($row=mysqli_fetch_row($result)) {
      if($row[0] === "free_ripple"){
      $flag2 ="OK";
      break;
    }
    }
    if($flag==="NO"){
        $sql = "CREATE TABLE `free` (
        `num` int(11) NOT NULL AUTO_INCREMENT,
        `id` char(15) NOT NULL,
        `name` char(10) NOT NULL,
        `title` varchar(100) NOT NULL,
        `content` text NOT NULL,
        `destination` char(100) NOT NULL,
        `file_name` char(25) NOT NULL,
        `file_type` char(25) NOT NULL,
        `del` text NOT NULL,
        `regist_day` char(20) DEFAULT NULL,
        `hit` int(11) DEFAULT NULL,
        PRIMARY KEY (`num`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        if(mysqli_query($conn,$sql)){
          echo "<script>alert('free 테이블이 생성되었습니다.');</script>";
        }else{echo "<script>alert('free 테이블이 생성에러.');</script>";}
      }
      if($flag2==="NO"){
          $sql = "CREATE TABLE `free_ripple` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `parent` int(11) NOT NULL,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          PRIMARY KEY (`num`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        if(mysqli_query($conn,$sql)){
          echo "<script>alert('free_ripple 테이블이 생성되었습니다.');</script>";
        }else{echo "<script>alert('free_ripple 테이블이 생성에러.');</script>";}
        }

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
