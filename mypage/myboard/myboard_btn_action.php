<?php
if(!session_id()) { session_start();}
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

if(isset($_POST['category'])){
  switch ($_POST['category']) {
    case 'list_head1':
    $tbl = 'qna';
    $th1  = '제목';
    $th2  = '작성일';
    $th3  = '조회';
    $date = 'regist_day';
    break;
    case 'list_head2':
    $tbl = 'member_review';
    $th1  = '제목';
    $th2  = '작성일';
    $th3  = '상품코드';
    $date = 'write_date';
    break;

    case 'list_head3':
    $tbl = 'free';
    $th1  = '제목';
    $th2  = '작성일';
    $th3  = '조회';
    $date = 'regist_day';
    break;
    default:
    $tbl = '';
    break;
  }
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM `$tbl` where id = '$id' order by `$date` desc";

  $result=mysqli_query($conn,$sql);
  $total_record=mysqli_num_rows($result);


  $output="";
  for ($i = 0; $i < $total_record; $i++){
    $row=mysqli_fetch_array($result);
    switch ($tbl) {
      case 'qna':
      $tbl = 'qna';
      $title = $row['title'];
      $date = $row['regist_day'];
      $field = $row['hit'];

      break;
      case 'member_review':
      $tbl = 'member_review';
      $title = $row['title'];
      $date = $row['write_date'];
      $field = $row['r_code'];
      $pk = $row['r_pk'];

      break;
      case 'free':
      $tbl = 'free';
      $title = $row['title'];
      $date = $row['regist_day'];
      $field = $row['hit'];

      break;
      default:
      $tbl = '';
      break;
    }
    if(isset($pk)){
      $output = $output."<tr><td><a id='$pk' onclick='review_form(this.id);'>$title</a></td><td>$date</td><td>$field</td></tr>";
    }else{
      $output = $output."<tr><td><a>$title</a></td><td>$date</td><td>$field</td></tr>";

    }
  }//end of for

}

echo '[{"th1":"'.$th1.'","th2":"'.$th2.'","th3":"'.$th3.'","output":"'.$output.'"}]';
 ?>
