<?php
session_start();

// isset함수는 불리언값을 리턴 true or false
// 비회원이면 권한없음
if(!isset($_SESSION['id'])){
  echo "<script>alert('회원가입 후 이용해주세요.');history.go(-1);</script>";
  exit;
}

// 인클루드 디비코넥터
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

// 변수선언(번호 이름 제목 내용 작성일 조회수 비밀여부)
$num=$name=$title=$content=$regist_day=$hit="";
// $secret_ok="공개";
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
    $pw=$row['pw'];
    $title= $row['title'];
    $content= $row['content'];
    $regist_day=$row['regist_day'];
    $hit=$row['hit'];

    if($mode == "response"){
      $title="[re]".$title;
      $content="";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <style media="screen">
      #qna img{
        max-width:400px;
      }
    </style>
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
    <script type="text/javascript">
    window.onload = function(){
      document.getElementById('secret_ok').onclick = function(){
        var check = document.getElementById('secret_ok');
        check = check.checked;
        var pw = document.getElementById('pw');
        if(check){
          pw.type = 'number';
        }else{
          pw.type = 'hidden';
        }
      }
    }
    </script>
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
            <input type="checkbox" id="secret_ok" name="secret_ok" value="">비밀글
            <input type="hidden" name="pw" id="pw">
          </td>
        </tr>
      </table>
        <div class="admin">
          <button id="admin_write_btn" onclick='document.qna_insert_form.submit();" type="button" name="button"'>완료</button>
          <a href="./qna_list.php"><button id="admin_write_btn" type="button" name="button">목록</button></a>
        </div>
      </form>
    </section>
    <br><br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
