<?php
function create_table($conn, $table_name){
  $flag="NO";
  $sql = "show tables from santteut";
  $result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

  while ($row=mysqli_fetch_row($result)) {
    if($row[0] === "$table_name"){
      $flag="OK";
      break;
    }
  }//end of while

  if($flag==="NO"){
    switch($table_name){
      //멤버테이블
      case 'member' :
          $sql = "CREATE TABLE `member` (
          `id` char(15) NOT NULL,
          `passwd` char(15) DEFAULT NULL,
          `passwd_confirm` char(15) DEFAULT NULL,
          `name` varchar(6) NOT NULL,
          `zip` char(5)  DEFAULT NULL,
          `address1` varchar(45) DEFAULT NULL,
          `address2` varchar(45) DEFAULT NULL,
          `hp1` char(12) DEFAULT NULL,
          `hp2` char(12) DEFAULT NULL,
          `email` varchar(45) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";
        break;
      default:
      echo "<script>alert('해당 테이블이름이 없습니다. ');</script>";
      break;
    }//end of switch

    if(mysqli_query($conn,$sql)){
      echo "<script>alert('$table_name 테이블이 생성되었습니다.');</script>";
    }else{
      echo "실패원인".mysqli_error($conn);
    }


  }//end of if flag

}//end of function

?>
