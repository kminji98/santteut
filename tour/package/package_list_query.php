<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

$sql=$result=$total_record=$total_pages=$start_record=$row="";
$total_record=0;

define('ROW_SCALE', 10);
define('PAGE_SCALE', 5);




if(isset($_GET['mode'])){
    $date=$_GET['mode'];
    $sql="SELECT * from `package` where `p_dp_date` = '$date' ;";
}else{
  if(isset($_POST['period_value'])){


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
    if(isset($_POST['dp_date_value'])){
      $dp_date_value =$_POST['dp_date_value'];
      $dp_date_value="and "." `p_dp_date` = "."'".$dp_date_value."'";
    }else{
      $dp_date_value="";
    }



    // echo  $city.','.$dp_date_value.','.$period_value.','.$pay_value.','.$time_value.','.$day_value.','.$add_value.','.$free_value;
    $sql="SELECT * from `package` where `p_dp_city` ='$city' $dp_date_value $period_value $pay_value $time_value $add_value $free_value;";
    echo  $sql;


  }else{
    $sql="SELECT * from `package`;";
  }

}

// 쿼리문실행문장
$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);

// 조건?참:거짓
$total_pages=ceil($total_record/ROW_SCALE);

// 페이지가 없으면 디폴트 페이지 1페이지
// if(empty($_GET['present_page'])){$present_page=1; }else{ $present_page=$_GET['present_page']; }
$present_page=(empty($_GET['present_page']))?1:$_GET['present_page'];

// 현재 블럭의 시작 페이지 = (ceil(현재페이지/블럭당 페이지 제한 수)-1) * 블럭당 페이지 제한 수 +1
//[[  EX) 현재 페이지 5일 때 => ceil(5/3)-1 * 3  +1 =  (2-1)*3 +1 = 4 ]]
$start_page= (ceil($present_page / PAGE_SCALE ) -1 ) * PAGE_SCALE +1 ;

// 현재페이지 시작번호 계산함.
//[[  EX) 현재 페이지 1일 때 => (1 - 1)*10 -> 0   ]]
//[[  EX) 현재 페이지 5일 때 => (5 - 1)*10 -> 40  ]]
$start_record=($present_page -1) * ROW_SCALE;

// 현재 블럭 마지막 페이지
// 전체 페이지가 (시작 페이지+페이지 스케일) 보다 크거나 같으면 마지막 페이지는 (시작페이지 + 페이지 스케일) -1 / 아니면 전체페이지 수 .
//[[  EX) 현재 블럭 시작 페이지가 6/ 전체페이지 : 10 -> '10 >= (6+10)' 성립하지 않음 -> 10이 현재블럭의 가장 마지막 페이지 번호  ]]
$end_page= ($total_pages >= ($start_page + PAGE_SCALE)) ? $start_page + PAGE_SCALE-1 : $total_pages;

// 리스트에 보여줄 번호를 최근순으로 부여함.
// 출력될 숫자
$view_num = $total_record - $start_record;


// 테이블 값가져오기
 ?>
