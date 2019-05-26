<?php
session_start();

// isset함수는 불리언값을 리턴 true or false
// 비회원이면 권한없음
if(!isset($_SESSION['id'])){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}

include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

// 변수선언(번호 이름 제목 내용 작성일 조회수 비밀여부)
$mode="insert";

$id= $_SESSION['id'];
$name= $_SESSION['name'];

// 모드가 수정 or 답글일때
if((isset($_GET["mode"])&&$_GET["mode"]=="update") || (isset($_GET["mode"])&&$_GET["mode"]=="response") ){

    $mode=$_GET["mode"];//update 또는 response $mode="update"or"response"
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //update 이면 해당된글, response이면 부모의 해당된글을 가져옴.
    $sql="SELECT * from `member_review` where num ='$q_num';";
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
    $regist_day=$row['regist_day'];
    $hit=$row['hit'];
    mysqli_close($conn);

    if($mode == "response"){
      $title="";
      $content=str_replace("<br>", "<br>▶",$content);
      $content="";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>산행후기</title>
  </head>
  <body>
    <section style="margin-left:10%;margin-top:1%;">
      <form class="member_review_insert_form" action="member_review_query.php?mode=<?=$mode;?>" method="post">
        <input type="hidden" name="num" value="<?=$num?>">
        <input type="hidden" name="code" value="<?=$p_code?>">
      <table border="1">
        <tr>
          <th>작성자</th>
          <td style="width:600px; text-align:center;"><?=$name?></td>
        </tr>
        <tr>
          <th>제목</th>
          <td><input type="text" style="font-size:15px; width:95%; padding:1%" name="title" value="<?=$title?>"></td>
        </tr>
        <tr>
          <th>내용</th>
          <td><textarea name="content" cols="80" rows="20"><?=$content?></textarea></td>
        </tr>
      </table>
      <br>
        <div>
          <button id="admin_write_btn" style="margin-left:25%" onclick='document.member_review_insert_form.submit();" type="button" name="button"'>완료</button>
        </div>
      </form>
    </section>
  </body>
</html>
