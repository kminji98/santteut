<?php
session_start();

// isset함수는 불리언값을 리턴 true or false
// 비회원이면 권한없음
if(!isset($_SESSION['id'])){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

// 1. 모드 = 후기작성
$mode="insert";
$readonly=$disabled=$title=$content=$name='';

$id= $_SESSION['id'];
$name= $_SESSION['name'];
$mode=isset($_GET["mode"])?$_GET["mode"]:'';
$r_pk=isset($_GET["r_pk"])?$_GET["r_pk"]:'';
$date =date("Y-m-d");
// 2. 모드 = 후기 확인
if((isset($_GET["mode"])&&$_GET["mode"]=="view") ){
  // view -> 수정 불가
    $readonly ='readonly';
    $disabled ='disabled';

    //view 이면 후기테이블에서 해당된 예약 번호를 조회.
    $sql="SELECT * from `member_review` where `r_pk` ='$r_pk';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('Error: ' . mysqli_error($conn));}
    $row=mysqli_fetch_array($result);

    $id=$row['id'];
    $title= htmlspecialchars($row['title']);
    // $title=str_replace("\n", "<br>",$title);
    // $title=str_replace(" ", "&nbsp;",$title);
    $content= htmlspecialchars($row['content']);
    // $content=str_replace("\n", "<br>",$content);
    // $content=str_replace(" ", "&nbsp;",$content);
    $date=$row['write_date'];
    $satisfaction_grade=$row['satisfaction_grade'];
    $schedule_grade=$row['schedule_grade'];
    $cost_grade=$row['cost_grade'];
    $meal_grade=$row['meal_grade'];
    echo '[{"disabled":"'.$disabled.'","readonly":"'.$readonly.'","id":"'.$id.'","r_pk":"'.$r_pk.'","title":"'.$title.'","content":"'.$content.'","write_date":"'.$date.'","satisfaction_grade":"'.$satisfaction_grade.'","schedule_grade":"'.$schedule_grade.'","cost_grade":"'.$cost_grade.'","meal_grade":"'.$meal_grade.'"}]';

    mysqli_close($conn);

}
?>
