<?php
session_start();

/////////테스트
$_SESSION['name']="이우주";
$_SESSION['id']="di0625";
/////////테스트

// isset함수는 불리언값을 리턴 true or false
// 비회원이면 권한없음
if(!isset($_SESSION['id'])){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}

// 인클루드 디비코넥터
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

// 변수선언(번호 이름 제목 내용 작성일 조회수 비밀여부)
$num=$name=$title=$content=$regist_day=$hit=$secret_ok="";

$mode="insert";

$name= $_SESSION['name'];

// 모드가 수정 or 답글일때
if((isset($_GET["mode"])&&$_GET["mode"]=="update") || (isset($_GET["mode"])&&$_GET["mode"]=="response") ){

    $mode=$_GET["mode"];//update 또는 response $mode="update"or"response"
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //update 이면 해당된글, response이면 부모의 해당된글을 가져옴.
    $sql="SELECT * from `qna` where num ='$q_num';";
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
    $file_name=$row['file_name'];
    $file_copied=$row['file_copied'];
    $file_type=$row['file_type'];
    $regist_day=$row['regist_day'];
    $hit=$row['hit'];
    mysqli_close($conn);

    if($mode == "response"){
      $title="[답글]".$title;
      $content="답글>".$content;
      $content=str_replace("<br>", "<br>▶",$content);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/qna/css/qna_form.css">
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="./js/qna_form.js?ver=0"></script>
    <title>문의하기</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/mini_menu.php";?>
    </header>
    <br><br><br>

    <section id="qna">
      <form class="qna_insert_form" action="qna_query.php?mode=<?php echo $mode; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="num" value="<?=$num?>">
        <input type="hidden" name="hit" value="<?=$hit?>">
      <table border="1">
        <tr>
          <th>작성자</th>
          <td style="width:600px; text-align:center;"><?=$name?></td>
        </tr>
        <tr>
          <th>제목</th>
          <td><input type="text" style="font-size:15px; width:100px;" name="title" value="<?=$title?>"></td>
        </tr>
        <tr style="height:400px;">
          <th>내용</th>
          <td><textarea name="content" id="summernote"><?=$content?></textarea></td>
        </tr>
        <tr>
          <th>비밀여부</th>
          <td>
            <select class="" name="">
              <option value="">공개</option>
              <option value="">비공개</option>
            </select>
          </td>
        </tr>
      </table>
        <div class="admin">
          <button id="admin_write_btn" onclick='document.qna_insert_form.submit();" type="button" name="button'>완료</button>
          <button id="admin_write_btn" type="button" name="button"><a href="./qna_list.php">목록</a></button>
        </div>
      </form>
    </section>
    <br><br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
