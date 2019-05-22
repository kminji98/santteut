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
          `id` char(20) NOT NULL,
          `passwd` char(15) DEFAULT NULL,
          `passwd_confirm` char(15) DEFAULT NULL,
          `name` varchar(10) NOT NULL,
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

      case 'package' :
          $sql = "CREATE TABLE `package` (
          `p_code` char(10) NOT NULL,
          `p_name` varchar(10) NOT NULL,
          `p_period` varchar(30) NOT NULL,
          `p_dp_date` varchar(20) NOT NULL,
          `p_dp_time` varchar(20) NOT NULL,
          `p_arr_time` varchar(20) NOT NULL,
          `p_pay` int(15)  NOT NULL,
          `p_add_pay` char(1) NOT NULL,
          `p_free_time` char(1) NOT NULL,
          `p_dp_city` varchar(20) NOT NULL,
          `p_arr_mt` varchar(20) NOT NULL,
          `p_detail_content` text NOT NULL,
          `p_main_img1` varchar(50) NOT NULL,
          `p_main_img2` varchar(50) NOT NULL,
          `p_main_img3` varchar(50) NOT NULL,
          `p_main_img_copy1` varchar(50) NOT NULL,
          `p_main_img_copy2` varchar(50) NOT NULL,
          `p_main_img_copy3` varchar(50) NOT NULL,
          `p_airplane_num` varchar(30) NOT NULL,
          `p_bus` int(10) NOT NULL,
          PRIMARY KEY (`p_code`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";
        break;

      case 'notice' :
        $sql = "CREATE TABLE `notice` (
        `num` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(20) NOT NULL,
        `content` text NOT NULL,
        `regist_day` date NOT NULL,
        `hit` int(11) unsigned NOT NULL,
        `file_name` varchar(45) DEFAULT NULL,
        `file_copied` varchar(45) DEFAULT NULL,
        `file_type` varchar(45) DEFAULT NULL,
        PRIMARY KEY (`num`)
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
