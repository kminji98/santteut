<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

$sql=$result=$total_record=$total_pages=$start_record=$row="";
$total_record=0;


//@@@@@@ MINJI 테스트
define('ROW_SCALE', 2);
define('PAGE_SCALE', 5);

$sql="SELECT * from `package`";

if(isset($_GET['mode'])){
  switch ($_GET['mode']) {
    //a. [SEARCH]
    // 옵션 선택 : find_option / 검색할 키워드 : find_input
    case 'search':
    $find_option= $_GET['find_option'];
    $find_input= $_GET['find_input'];
    $sql="SELECT * from `package` where $find_option like '%$find_input%';";
    break;

    //b. [DETAIL] 상세검색 : 조건이 sql값으로 넘어옴(POST)
    case 'detail':
    $sql=$_POST['sql'];
    $output=$_POST['output'];

    break;

    //@@@@@@ MINJI 테스트
    // //c. [RECENT] 최신순
    // case 'recent':
    // //$_POST['order'] =>  'desc' / 'asc'
    // // ex) $sql="SELECT * from `package` order by num desc";
    // $sql= $sql." order by `p_dp_date`"." ".$_POST['order'];
    // break;
    // //d. [PAY] 요금순
    // case 'pay':
    // $sql= $sql." order by `p_pay` ".$_POST['order'];
    // break;
    // //e. [POPULAR] 인기순 (예약이 많이 된 순)
    // case 'popular':
    // // select * from package inner join bus on bus.b_code = package.p_code order by b_people;
    // $sql =$sql." inner join bus on bus.b_code = package.p_code order by b_people";
    // // desc OR asc
    // $sql= $sql." ".$_POST['order'];
    // break;

    // [DATE] 날짜검색 : 모드가 날짜로 넘어옴(GET)
    default:
      $date=$_GET['mode'];
      $sql=$sql." where `p_dp_date` = '$date';";
      break;
  }
  // if($_GET['mode'] == 'search' && isset($_GET['find_option'])&& isset($_GET['find_input'])){
  //   $sql="SELECT * from `package` where $find_option like '%$q_find_input%';";
  // }else{
  // }
  //
  // if($_GET['mode'] =='detail' && isset($_POST['sql'])){
  // //[DETAIL SEARCH]
  // }
}

// 쿼리문실행문장
$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);

// 조건?참:거짓
$total_pages=ceil($total_record/ROW_SCALE);

// 페이지가 없으면 디폴트 페이지 1페이지
// if(empty($_GET['page'])){$page=1; }else{ $page=$_GET['page']; }
$page=(empty($_GET['page']))?1:$_GET['page'];

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


// 테이블 값가져오기
 ?>
