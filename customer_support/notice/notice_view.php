<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/notice/css/notice_view.css">
    <title>공지사항</title>
  </head>
  <body>
    <!--로그인 회원가입 로그아웃-->
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/mini_menu.php";?>
    </header>
    <br><br><br>

    <section id="notice">
      <table border="1">
        <tr>
          <th>작성자</th>
          <td style="width:600px; text-align:center;">관리자</td>
        </tr>
        <tr>
          <th>제목</th>
          <td></td>
        </tr>
        <tr style="height:400px;">
          <th>내용</th>
          <td></td>
        </tr>
        <tr>
          <th>파일</th>
          <td style="text-align:center;"></td>
        </tr>
      </table>
    <div class="admin">
      <button id="admin_write_btn" type="button" name="button">수정</button>
      <button id="admin_write_btn" type="button" name="button">삭제</button>
      <button id="admin_write_btn" type="button" name="button">목록</button>
    </div>


    </section>
    <br>
<br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
