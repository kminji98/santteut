s<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

$num=$name=$title=$content=$regist_day=$hit="";

// 페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){$page=1;}else{$page=$_GET['page'];}


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
    $hit=$row['hit'];
    $title= htmlspecialchars($row['title']);
    $content= $row['content'];
    $title=str_replace("\n", "<br>",$title);
    $title=str_replace(" ", "&nbsp;",$title);
    $file_name=$row['file_name'];
    $file_copied=$row['file_copied'];
    $file_type=$row['file_type'];
    $regist_day=$row['regist_day'];
}

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/notice/css/notice_view.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <script type="text/javascript" src="./js/notice_view.js?ver=1"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#not_mini").css("font-weight","bold");
        $("#not_mini").css("color","black");
      });
    </script>
    <title>공지사항</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/custom_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    </header>
    <section id="notice">
      <table border="1">
        <tr><th>작성자</th><td style="width:600px; text-align:center;">관리자</td></tr>
        <tr><th>제목</th><td><?=$title?></td></tr>
        <tr style="height:400px;"><th>내용</th>
          <td>
            <!--이미지면 보여줌-->
            <?php
              //1. 해당된 가입자이고, 파일이 있으면, 파일명, 파일사이즈, 실제위치 정보확인
              if(!empty($_SESSION['id']) && !empty($file_copied)){
                $file_path = "./data/".$file_copied;
                $file_size = filesize($file_path);
              }
            ?>
            <!--다른 내용 보여줌-->
            <?=$content?>
          </td>
        </tr>
        <tr>
          <th>파일</th>
          <td style="text-align:center; text-decoration: none;">
            <?php
              //2. 업로드된 이름을 보여주고 [저장] 할것인지 선택한다.
              echo ("
                첨부파일 : $file_name &nbsp; [ $file_size Byte ]
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
                <a style='text-decoration: none; color:black;' href='notice_download.php?mode=download&num=$q_num'>[저장]</a></b><br>
              ");
            ?>
          </td>
        </tr>
      </table>
      <div class="admin">
        <?php
        //관리자일경우 수정,삭제가 가능하도록 설정
        if(!empty($_SESSION['id']) && ($_SESSION['id']=="admin")){
          echo ('<a href="./notice_form.php?mode=update&num='.$num.'"><input id="admin_write_btn" type="button" value="수정">&nbsp;</a>&nbsp;');
          echo ('<input id="admin_write_btn" type="button" value="삭제" onclick="check_delete('.$num.')">&nbsp;</a>&nbsp;');
          echo ('<a href="./notice_list.php?page='.$page.'"><input id="admin_write_btn" type="button" value="목록">&nbsp;</a>');
        }else{
          echo ('<div class="notice_list" style="margin-left: 25.5%;">
          <a href="./notice_list.php?page='.$page.'"><input type="button" value="목록">&nbsp;</a>
          </div>');
        }
        ?>
      </div>
    </section>
    <br>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
