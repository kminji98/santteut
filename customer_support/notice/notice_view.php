<?php
session_start();
$_SESSION['name']="관리자";
$_SESSION['id']="admin";

// isset함수는 불리언값을 리턴 true or false
// 회원 or 비회원이면 권한없음, 관리자일때만 입장
if(!(isset($_SESSION['id']) &&  $_SESSION['id']=="admin")){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}

include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

$num=$name=$title=$content=$regist_day=$hit="";


// $image_width="";

// 페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['present_page'])){$present_page=1;}else{$present_page=$_GET['present_page'];}


if(isset($_GET["num"]) && !empty($_GET["num"])){
    $num = test_input($_GET["num"]);
    $hit = test_input($_GET["hit"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    $sql="UPDATE `notice` SET `hit`=$hit WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql="SELECT * from `notice` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $name=$row['name'];
    $hit=$row['hit'];
    $title= htmlspecialchars($row['title']);
    $content= htmlspecialchars($row['content']);
    $title=str_replace("\n", "<br>",$title);
    $title=str_replace(" ", "&nbsp;",$title);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $file_name=$row['file_name'];
    $file_copied=$row['file_copied'];
    $file_type=$row['file_type'];
    $regist_day=$row['regist_day'];

    // 이미지 연관부분
      //숫자 0 " " '0' null 0.0   $a = array()
      // if(!empty($file_copied)){
      //   //이미지 정보를 가져오기 위한 함수 width, height, type
      //   $image_info=getimagesize("./data/".$file_copied);
      //   $image_width=$image_info[0];
      //   $image_height=$image_info[1];
      //   $image_type=$image_info[2];
      //   if($image_width>400) $image_width = 400;
      // }else{
      //   $image_width=0;
      //   $image_height=0;
      //   $image_type="";
      // }
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/notice/css/notice_view.css">
    <script type="text/javascript" src="./js/notice_view.js?ver=1"></script>

    <title>공지사항</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/mini_menu.php";?>
    </header>
    <br><br><br><br>

    <section id="notice">
      <table border="1">
        <tr>
          <th>작성자</th>
          <td style="width:600px; text-align:center;"><?$_SESSION['name']?></td>
        </tr>
        <tr>
          <th>제목</th>
          <td><?$title?></td>
        </tr>

        <!--여기서 다시 수정-->
        <tr style="height:400px;">
          <th>내용</th>
          <td>
            <!--이미지면 보여줌-->
            <?php
              //1. 해당된 가입자이고, 파일이 있으면, 파일명, 파일사이즈, 실제위치 정보확인
              if(!empty($_SESSION['id']) && !empty($file_copied)){
                $file_path = "./data/".$file_copied;
                $file_size = filesize($file_path);
                //2. 업로드된 이름을 보여주고 [저장] 할것인지 선택한다.

                echo ("
                  첨부파일 : $file_name &nbsp; [ $file_size Byte ]
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href='notice_download.php?mode=download&num=$q_num'>저장</a><br><br>
                ");
              }
            ?>
            <!--다른 내용 보여줌-->
            <?=$content?>
          </td>
        </tr>
        <tr>
          <th>파일</th>
          <td style="text-align:center;"></td>
        </tr>
      </table>
    <div class="admin">

      <button id="admin_write_btn" type="button" name="button"><a href="./notice_form.php?mode=update&num=<?$num?>">수정</a></button>
      <button id="admin_write_btn" type="button" name="button" onclick="check_delete(<?$num?>)">삭제</button>
      <button id="admin_write_btn" type="button" name="button"><a href="./notice_list.php?present_page=<?=$present_page?>">목록</a></button>
    </div>
    </section>
    <br>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
