<?php
function create_table($conn, $table_name){
  $flag = "NO";
  $sql = "show tables from santteut";
  $result = mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn));

  while($row=mysqli_fetch_row($result)){
    if($row[0]==="$table_name"){
      $flag = "OK";
      break;
    }//end of if
  }//end of while

  if($flag==="NO"){
    switch($table_name){
      case 'official_review':
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
      ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;";
      break;

      case 'official_review_ripple' :
      $sql = "CREATE TABLE `official_review_ripple` (
      `num` int(11) NOT NULL AUTO_INCREMENT,
      `parent` int(11) NOT NULL,
      `id` char(15) NOT NULL,
      `name` char(10) NOT NULL,
      `content` text NOT NULL,
      `regist_day` char(20) DEFAULT NULL,
      PRIMARY KEY (`num`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;

    }//end of switch
      if(mysqli_query($conn, $sql)){
        echo "<script>alert('$table_name table 생성완료');</script>";
      }
  }//end of if
}//end of function create_table($conn, $table_name)


?>
