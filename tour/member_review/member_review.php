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
$readonly=$disabled='';

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
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //view 이면 후기테이블에서 해당된 예약 번호를 조회.
    $sql="SELECT * from `member_review` where `r_pk` ='$r_pk';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('Error: ' . mysqli_error($conn));}
    $row=mysqli_fetch_array($result);

    $id=$row['id'];
    $title= htmlspecialchars($row['title']);
    $title=str_replace("\n", "<br>",$title);
    $title=str_replace(" ", "&nbsp;",$title);
    $content= htmlspecialchars($row['content']);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $date=$row['write_date'];
    $grade=$row['grade'];
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>산행후기</title>
    <style media="screen">
      #review_section{
        margin-left:14%;margin-top:1%;
      }
      #review_tbl{
        width:60%; text-align:center;
        font-size: 15px;margin-top: 10%;
        border-collapse: collapse;
        border-color: #828282;
        color:  #252525;
      }
      #review_tbl tr th{
        padding:30px;
      }
      #title{
        font-size:15px; width:95%; padding:1%;
      }

    </style>
  </head>
  <body>
    <section id="review_section" >
      <form class="member_review_insert_form" action="member_review_query.php?mode=<?=$mode?>" method="post">
        <input type="hidden" name="r_pk" value="<?=$r_pk?>">
      <table id="review_tbl" border="1">
        <tr>
          <th style="padding:8px">작성자</th>
          <td colspan="3"><?=$name?></td>
        </tr>
        <tr>
          <th style="padding:0">제목</th>
          <td colspan="3"><input type="text" id="title" name="title" value="<?=$title?>" <?=$readonly?> maxlength="30"></td>
        </tr>
        <tr>
          <th style="padding:0">작성일</th>
          <td><?=$date?></td>
          <td><b>평점</b></td>
          <td>
            <select class="" name="grade" style="padding:3%;margin:2%;width:80px;" <?=$disabled?>>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
            <option value="1">1</option>
            </select>
          </td>
        </tr>
        <tr>
          <th>내용</th>
          <td colspan="3"><textarea name="content" cols="80" rows="10" maxlength="100" placeholder="100자 이내로 입력해주세요." <?=$readonly?>><?=$content?></textarea></td>
        </tr>
      </table>
      <br>
        <div>
          <button id="admin_write_btn" style="margin-left:36%; padding:2%" onclick='document.member_review_insert_form.submit();" type="button" name="button"'>완료</button>
        </div>
      </form>
    </section>
  </body>
</html>
