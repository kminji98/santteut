<?php
  session_start();
  session_destroy();
  $id_flag = $_SESSION['id'];
  $id_flag.substr($id_flag,-2);
  //google 아이디인 경우
  if($id_flag=='@g'){
    header("Location:https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/santteut/index.php");
  }else{
    header("Location:../../index.php");
  }
?>
