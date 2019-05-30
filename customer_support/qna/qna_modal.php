<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

if(isset($_GET['mode']) && $_GET['mode']=='pass'){
  $num = $_POST['num'];

  $sql = "SELECT `pw` FROM `qna` WHERE `num` = '$num';";
  $result = mysqli_query($conn,$sql);
  if (!$result) {die('Error: ' . mysqli_error($conn));}
  $row=mysqli_fetch_array($result);
  $pw=$row['pw'];
  echo $pw;
}
 ?>
