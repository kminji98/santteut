<?php
if($_POST['mode']=="detail"){
  if(isset($_POST['period_value'])){
    $period_value =$_POST['period_value'];
  }else{
    $period_value="";
  }
  if(isset($_POST['pay_value'])){
    $pay_value =$_POST['pay_value'];
  }else{
    $pay_value="";
  }
  if(isset($_POST['time_value'])){
    $time_value =$_POST['time_value'];
  }else{
    $time_value="";
  }
  if(isset($_POST['day_value'])){
    $day_value =$_POST['day_value'];
  }else{
    $day_value="";
  }
  if(isset($_POST['add_value'])){
    $add_value =$_POST['add_value'];
  }else{
    $add_value="";
  }
  if(isset($_POST['free_value'])){
    $free_value =$_POST['free_value'];
  }else{
    $free_value="";
  }
  if(isset($_POST['city'])){
    $city =$_POST['city'];
  }else{
    $city="";
  }
  if(!empty($_POST['dp_date_value'])){
    $dp_date_value =$_POST['dp_date_value'];
    $dp_date_value="and "." `p_dp_date` = "."'".$dp_date_value."'";
  }else{
    $dp_date_value="";
  }
  // echo  $city.','.$dp_date_value.','.$period_value.','.$pay_value.','.$time_value.','.$day_value.','.$add_value.','.$free_value;

  $sql="SELECT * from `package` where `p_dp_city` ='$city' $dp_date_value $day_value $period_value $pay_value $time_value $add_value $free_value;";
  echo  $sql;
}
 ?>
