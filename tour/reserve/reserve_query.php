<?php
  include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
  session_start();
  $id = $_SESSION['id'];
  $code=$_POST['code'];
  $seat=$_POST['seat'];
  $member_num=$_POST['member_num'];
  $adult=$_POST['adult'];
  $kid=$_POST['kid'];
  $baby=$_POST['baby'];

  $sql_bus="INSERT INTO `bus`
  VALUES(
  '$id',
  '$code',
  '$member_num',
  '$seat')";

  $date =date("Y-m-d");
  $cancel="1";
  $sql_reserve="INSERT INTO `reserve`
  VALUES(
  '$code',
  '$id',
  '$date',
  '$adult',
  '$kid',
  '$baby',
  '$cancel'
  )";
  mysqli_query($conn,$sql_bus);
  mysqli_query($conn,$sql_reserve);
  echo $date;

 ?>
