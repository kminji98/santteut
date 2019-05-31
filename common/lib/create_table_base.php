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
        ) DEFAULT CHARSET=utf8;
        ";
      break;

      case 'package' :
          $sql = "CREATE TABLE `package` (
          `p_code` char(10) NOT NULL,
          `p_name` varchar(150) NOT NULL,
          `p_period` varchar(30) NOT NULL,
          `p_dp_date` varchar(20) NOT NULL,
          `p_dp_day`  char(1) ,
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
          ) DEFAULT CHARSET=utf8;
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
        ) DEFAULT CHARSET=utf8;
        ";
      break;

      case 'bus' :
         $sql = "CREATE TABLE `bus` (
         `b_pk` varchar(30) ,
         `b_id` varchar(30) ,
         `b_code` varchar(20) NOT NULL,
         `b_people` int(10) ,
         `b_seat` varchar(130)
          ) DEFAULT CHARSET=utf8;
          ";
      break;

      case 'official_review' :
        $sql = "CREATE TABLE `official_review` (
        `num` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(100) NOT NULL,
        `content` text NOT NULL,
        `regist_day` char(20) DEFAULT NULL,
        `main_img` char(50) NOT NULL,
        `file_name_0` char(40) DEFAULT NULL,
        `file_copied_0` char(30) DEFAULT NULL,
        `file_type_0` char(30) DEFAULT NULL,
        `file_name_1` char(40) DEFAULT NULL,
        `file_copied_1` char(30) DEFAULT NULL,
        `file_type_1` char(30) DEFAULT NULL,
        `file_name_2` char(40) DEFAULT NULL,
        `file_copied_2` char(30) DEFAULT NULL,
        `file_type_2` char(30) DEFAULT NULL,
        `file_name_3` char(40) DEFAULT NULL,
        `file_copied_3` char(30) DEFAULT NULL,
        `file_type_3` char(30) DEFAULT NULL,
        `file_name_4` char(40) DEFAULT NULL,
        `file_copied_4` char(30) DEFAULT NULL,
        `file_type_4` char(30) DEFAULT NULL,
        PRIMARY KEY (`num`)
        ) DEFAULT CHARSET=utf8;";
     break;

     case 'mt_information' :
     $sql = "CREATE TABLE `mt_information` (
         `num` int(11) NOT NULL AUTO_INCREMENT,
         `title` varchar(100) NOT NULL,
         `content` text NOT NULL,
         `regist_day` char(20) DEFAULT NULL,
         `main_img` char(50) NOT NULL,
         `file_name_0` char(40) DEFAULT NULL,
         `file_copied_0` char(30) DEFAULT NULL,
         `file_type_0` char(30) DEFAULT NULL,
         `file_name_1` char(40) DEFAULT NULL,
         `file_copied_1` char(30) DEFAULT NULL,
         `file_type_1` char(30) DEFAULT NULL,
         `file_name_2` char(40) DEFAULT NULL,
         `file_copied_2` char(30) DEFAULT NULL,
         `file_type_2` char(30) DEFAULT NULL,
         `file_name_3` char(40) DEFAULT NULL,
         `file_copied_3` char(30) DEFAULT NULL,
         `file_type_3` char(30) DEFAULT NULL,
         `file_name_4` char(40) DEFAULT NULL,
         `file_copied_4` char(30) DEFAULT NULL,
         `file_type_4` char(30) DEFAULT NULL,
         PRIMARY KEY (`num`)
         ) DEFAULT CHARSET=utf8;";
     break;

     case 'official_review_ripple' :
       $sql = "CREATE TABLE `official_review_ripple` (
       `num` int(11) NOT NULL AUTO_INCREMENT,
       `parent` int(11) NOT NULL,
       `id` char(20) NOT NULL,
       `name` char(50) NOT NULL,
       `content` text NOT NULL,
       `regist_day` char(20) DEFAULT NULL,
       PRIMARY KEY (`num`)
       ) DEFAULT CHARSET=utf8;";
      break;

     case 'mt_information_ripple' :
       $sql = "CREATE TABLE `mt_information_ripple` (
       `num` int(11) NOT NULL AUTO_INCREMENT,
       `parent` int(11) NOT NULL,
       `id` char(20) NOT NULL,
       `name` char(50) NOT NULL,
       `content` text NOT NULL,
       `regist_day` char(20) DEFAULT NULL,
       PRIMARY KEY (`num`)
       ) DEFAULT CHARSET=utf8;";
     break;

     case 'reserve' :
        $sql = "CREATE TABLE `santteut`.`reserve` (
        `r_pk` CHAR(30) NOT NULL,
        `r_code` CHAR(10) NOT NULL,
        `r_id` VARCHAR(45) NOT NULL,
        `r_date` VARCHAR(45) NOT NULL,
        `r_cancel_date` VARCHAR(45),
        `r_adult` INT NOT NULL,
        `r_kid` INT NOT NULL,
        `r_baby` INT NOT NULL,
        `r_cancel` INT NOT NULL,
        `r_pay` VARCHAR(15) NOT NULL
        ) DEFAULT CHARSET=utf8;";
     break;

     case 'bill' :
        $sql = "CREATE TABLE `bill`(
        `b_pk` CHAR(30) NOT NULL,
        `b_code` varchar(10),
        `b_id` varchar(20),
        `b_date` varchar(15),
        `b_way` char(1),
        `b_pay` varchar(15)
        ) DEFAULT CHARSET=utf8;";
        break;

     case 'qna' :
       $sql = "CREATE TABLE `qna` (
       `num` int(11) unsigned NOT NULL AUTO_INCREMENT,
       `groupnum` int(11) unsigned NOT NULL,
       `depth` int(11) unsigned NOT NULL,
       `ord` int(11) unsigned NOT NULL,
       `id` varchar(20) NOT NULL,
       `title` varchar(100) NOT NULL,
       `content` text NOT NULL,
       `regist_day` date NOT NULL,
       `hit` int(11) unsigned NOT NULL,
       `pw` varchar(50) DEFAULT NULL,
       PRIMARY KEY (`num`)
       ) DEFAULT CHARSET=utf8;
       ";
    break;
     case 'member_review' :
       $sql = "CREATE TABLE `member_review` (
       `num` int(11) NOT NULL AUTO_INCREMENT,
       `r_code` varchar(10) NOT NULL,
       `r_pk` char(30) NOT NULL,
       `title` varchar(100) NOT NULL,
       `content` text NOT NULL,
       `id` char(20) NOT NULL,
       `name` char(10) NOT NULL,
       `write_date` date NOT NULL,
       `satisfaction_grade` int not null,
       `schedule_grade` int not null,
       `cost_grade` int not null,
       `meal_grade` int not null,
       PRIMARY KEY (`num`)
       ) DEFAULT CHARSET=utf8;
       ";
    break;

    case 'cart' :
      $sql = "CREATE TABLE `cart` (
      `c_code` varchar(10) ,
      `c_id` varchar(20)
      ) DEFAULT CHARSET=utf8;
      ";
     break;

    case 'free' :
     $sql = "CREATE TABLE `free` (
     `num` int(11) NOT NULL AUTO_INCREMENT,
     `title` varchar(100) NOT NULL,
     `content` text NOT NULL,
     `file_name` char(25) NOT NULL,
     `file_type` char(25) NOT NULL,
     `file_copied` char(25) NOT NULL,
     `regist_day` char(20) DEFAULT NULL,
     `hit` int(11) DEFAULT NULL,
     PRIMARY KEY (`num`)
     ) DEFAULT CHARSET=utf8;";
     break;

     case 'free_ripple' :
     $sql = "CREATE TABLE `free_ripple` (
     `num` int(11) NOT NULL AUTO_INCREMENT,
     `parent` int(11) NOT NULL,
     `id` char(20) NOT NULL,
     `name` char(10) NOT NULL,
     `content` text NOT NULL,
     `regist_day` char(20) DEFAULT NULL,
     PRIMARY KEY (`num`)
     ) DEFAULT CHARSET=utf8;";
      break;

      case 'message' :
      $sql = "CREATE TABLE `message` (
          `num` int not null auto_increment,
          `recv_id` varchar(15) not null,
          `send_id` varchar(15) not null,
          `name` char(10) not null,
          `message` text not null,
          `recv_read` char(2) not null default 'N',
          `regist_day` char(20),
          PRIMARY KEY(num)
      ) DEFAULT CHARSET=utf8;";
        break;
    default:
      echo "<script>alert('해당 테이블이름이 없습니다. ');</script>";
      exit;
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
