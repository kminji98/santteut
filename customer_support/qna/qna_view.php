<?php
session_start();

// isset함수는 불리언값을 리턴 true or false
// 비회원이면 권한없음
if(!isset($_SESSION['id'])){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

$num=$name=$title=$content=$regist_day=$hit="";
$secret_ok="";

// 페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){$page=1;}else{$page=$_GET['page'];}

if(isset($_GET["num"]) && !empty($_GET["num"])){
    $num = test_input($_GET["num"]);
    $hit = test_input($_GET["hit"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    $sql="UPDATE `qna` SET `hit`=$hit WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('Error: ' . mysqli_error($conn));}

// 디비에서 값을 가져와서 보여줌
    $sql="SELECT * from `qna` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('Error: ' . mysqli_error($conn));}
    $row=mysqli_fetch_array($result);
    $hit=$row['hit'];
    $secret_ok=$row['secret_ok'];
    $title= htmlspecialchars($row['title']);
    $content= $row['content'];
    $title=str_replace("\n", "<br>",$title);
    $title=str_replace(" ", "&nbsp;",$title);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $regist_day=$row['regist_day'];
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/qna/css/qna_view.css">
    <script type="text/javascript" src="./js/qna_view.js?ver=1"></script>

    <title>문의하기</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/mini_menu.php";?>
    </header>
    <br><br><br>

    <section id="qna">
      <table border="1">
        <tr>
          <th>작성자</th>
          <td style="width:600px; text-align:center;"><?=$_SESSION['name']?></td>
        </tr>
        <tr>
          <th>제목</th>
          <td><?=$title?></td>
        </tr>
        <tr style="height:400px;">
          <th>내용</th>
          <td><?=$content?></td>
        </tr>
        <tr>
          <th>비밀여부</th>
          <td><?=$secret_ok?></td>
        </tr>

      </table>
    <div class="admin">
      <a href="./qna_form.php?mode=update&num=<?=$num?>"><button id="admin_write_btn" type="button" name="button">수정</button></a>
      <button id="admin_write_btn" type="button" name="button" onclick="check_delete(<?=$num?>)">삭제</button>
      <a href="./qna_form.php?mode=response&num=<?=$num?>"><button id="admin_write_btn" type="button" name="button">답글</button></a>
      <a href="./qna_list.php?page=<?=$page?>"><button id="admin_write_btn" type="button" name="button">목록</button></a>
    </div>
<!--  -->
    <?php
      // if(isset($_SESSION['id'])){
      //   if($_SESSION['id']=="admin" || $_SESSION['id']==$id){
          // echo('<a href="./qna_form.php?mode=update&num='.$num.'"> <button id="admin_write_btn" type="button" name="button">목록</button></a>');
          // echo('<img src="../img/delete.png" onclick="check_delete('.$num.')">&nbsp;'); 삭제
      //   }
      // }
      // if(!empty($_SESSION['id'])){
        // echo '<a href="qna_form.php?mode=response&num='.$num.'">답글</a>';
        // echo '<a href="qna_form.php"><img src="../img/write.png"></a>';
      // }
    ?>
<!--  -->
    </section>
    <br>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
