<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
session_start();
$id=$_SESSION['id'];
$cancel_r_pk = $_GET["r_pk"];

if(isset($_GET["r_pk"])){
  $up_sql = "UPDATE `reserve` SET `r_cancel` = '1' where `r_pk`= '$cancel_r_pk';";
  $up_result = mysqli_query($conn,$up_sql);
}
header("Location: reserve_list.php");

?>
