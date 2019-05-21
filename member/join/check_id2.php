<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
if(isset($_GET["mode"]) && $_GET["mode"]=='id_check'){
      $idcheck=$_GET["id"];
      // var_dump($idcheck);
    if(empty($_GET["id"])){
      echo "아이디값이 없습니다. 아이디값을 입력하세요";
      return;
    }else{
      $q_idcheck = mysqli_real_escape_string($conn, $idcheck);
      $sql="SELECT * FROM member where id = '$q_idcheck'";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }
      $rowcount=mysqli_num_rows($result);
      // var_dump($rowcount);
      if ($rowcount) {
        $s = '아이디가 이미 존재합니다.';
       } else {
        $s = '사용가능합니다.';
       }
       echo $s;
  }
}
 ?>
