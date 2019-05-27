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


  $money=$_POST['money'];

  // echo $money;



  $sql_bus="INSERT INTO `bus`
  VALUES(
  '$pk',
  '$id',
  '$code',
  '$member_num',
  '$seat')";
  $pk=date("Y-m-d-H-i-s",time());
  srand((double)microtime()*1000000); //난수값 초기화
  $mil=rand(100000,999999);
  $pk=$pk."-".$mil;


  $date =date("Y-m-d");
  $cancel="1";
  $sql_reserve="INSERT INTO `reserve`
  VALUES(
  '$pk',
  '$code',
  '$id',
  '$date',
  '$adult',
  '$kid',
  '$baby',
  '$cancel',
  '$money'
  )";
  mysqli_query($conn,$sql_bus);
  mysqli_query($conn,$sql_reserve);
  // echo $date;



 ?>
