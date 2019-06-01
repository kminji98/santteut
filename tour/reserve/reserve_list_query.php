<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
session_start();
$id=$_SESSION['id'];
$cancel_r_pk = $_GET["r_pk"];
$date =date("Y-m-d");

if(isset($_GET["r_pk"])){
  if($_GET["mode"]=="delete"){
    $del_sql = "DELETE from `bill` where `b_pk`= '$cancel_r_pk';";
    $del_result = mysqli_query($conn,$del_sql);




  }
  $del_sql2 = "DELETE from `bus` where `b_pk`= '$cancel_r_pk';";
  $del_result2 = mysqli_query($conn,$del_sql2);

  $up_sql = "UPDATE `reserve` SET `r_cancel` = '1',`r_adult`=0,`r_kid`=0,`r_baby`=0 where `r_pk`= '$cancel_r_pk';";
  $up_result = mysqli_query($conn,$up_sql);
  $cancel_date_sql = "UPDATE `reserve` SET `r_cancel_date` = '$date' where `r_pk`= '$cancel_r_pk';";
  $date_result = mysqli_query($conn,$cancel_date_sql);
}
header("Location: reserve_list.php");

?>
