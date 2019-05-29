<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

$sql=$result=$total_record=$total_pages=$start_record=$row="";
$total_record=0;

//@@@@@@ MINJI 테스트//@@성훈테스트
define('ROW_SCALE', 10);
define('PAGE_SCALE', 5);
if(isset($_GET['divide'])) $divide=$_GET['divide'];
if(isset($_POST['divide'])) $divide=$_POST['divide'];


if(isset($_GET['divide'])=="domestic"){
  $sql="SELECT * from `package` where `p_airplane_num` ='0'";
}else if(isset($_GET['divide'])=="abroad"){
  $sql="SELECT * from `package` where `p_airplane_num` !='0'";
}else{
  $sql="SELECT * from `package`";
}

if(isset($_GET['mode'])){
  switch ($_GET['mode']) {
    //A. [SEARCH]
    // 옵션 선택 : find_option / 검색할 키워드 : find_input
    case 'search':
    $find_option= $_GET['find_option'];
    $find_input= $_GET['find_input'];
    if($_GET['divide']=="domestic"){
    $sql="SELECT * from `package` where $find_option like '%$find_input%' and `p_airplane_num` ='0';";
  }else if($_GET['divide']=="abroad"){
    $sql="SELECT * from `package` where $find_option like '%$find_input%' and `p_airplane_num` !='0';";
  }else{
    $sql="SELECT * from `package` where $find_option like '%$find_input%';";
  }
    break;

    //B. [DETAIL] 상세검색 : 조건이 sql값으로 넘어옴(POST)
    case 'detail':
    $sql=$_POST['sql'];
    $output=$_POST['output'];
    $page=$_POST['page'];
    break;

    //@@@@@@ MINJI 테스트

    //C. [ORDER] 최신순▼요금순▼ : 조건, 내림차순/오름차순(POST)
    //최신순▼요금순▼
    case 'order':
    // $_POST['order'] =>  'desc' / 'asc'
    // ex) $sql="SELECT * from `package` order by num desc";
    $sql= $sql." order by";
    $order_btn = $_POST['order_btn'];
    $order_condition = $_POST['order_condition'];
    $order_option = $_POST['order_option'];
    break;

    //D. [DATE] 날짜검색 : 모드가 날짜로 넘어옴(GET)
    default:
      $date=$_GET['mode'];
      $sql="SELECT * from `package`";
      $sql=$sql." where `p_dp_date` = '$date'";
      if($_GET['divide']=="domestic"){
        $sql=$sql." and `p_airplane_num` ='0';";
      }else if($_GET['divide']=="abroad"){
        $sql=$sql." and `p_airplane_num` !='0';";
      }
      break;
  }

  if($_GET['mode']=="order"){
    switch ($_POST['order_condition']) {
      //C.1 [RECENT] 최신순
      case '최신':
      $sql= $sql." `p_dp_date`";
      break;

      //C.2 [RECENT] 최신순
      case '요금':
      $sql= $sql." `p_pay`";
      break;

      default:
        break;
    }
    $sql= $sql." ".$_POST['order_option'];

  }

}

// 쿼리문실행문장
$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);

// 조건?참:거짓
$total_pages=ceil($total_record/ROW_SCALE);


// 페이지가 없으면 디폴트 페이지 1페이지
$page=(empty($_GET['page']))?1:$_GET['page'];

if(isset($_POST['page'])){
  $page=(empty($_POST['page']))?1:$_POST['page'];
}

// 현재 블럭의 시작 페이지 = (ceil(현재페이지/블럭당 페이지 제한 수)-1) * 블럭당 페이지 제한 수 +1
//[[  EX) 현재 페이지 5일 때 => ceil(5/3)-1 * 3  +1 =  (2-1)*3 +1 = 4 ]]
$start_page= (ceil($page / PAGE_SCALE ) -1 ) * PAGE_SCALE +1 ;


// 현재페이지 시작번호 계산함.
//[[  EX) 현재 페이지 1일 때 => (1 - 1)*10 -> 0   ]]
//[[  EX) 현재 페이지 5일 때 => (5 - 1)*10 -> 40  ]]
$start_record=($page -1) * ROW_SCALE;


// 현재 블럭 마지막 페이지
// 전체 페이지가 (시작 페이지+페이지 스케일) 보다 크거나 같으면 마지막 페이지는 (시작페이지 + 페이지 스케일) -1 / 아니면 전체페이지 수 .
//[[  EX) 현재 블럭 시작 페이지가 6/ 전체페이지 : 10 -> '10 >= (6+10)' 성립하지 않음 -> 10이 현재블럭의 가장 마지막 페이지 번호  ]]
$end_page= ($total_pages >= ($start_page + PAGE_SCALE)) ? $start_page + PAGE_SCALE-1 : $total_pages;


// 리스트에 보여줄 번호를 최근순으로 부여함.
// 출력될 숫자
$view_num = $total_record - $start_record;


// echo $sql;
// 테이블 값가져오기
 ?>
