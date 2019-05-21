<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/notice/css/notice_form.css">
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script src="./js/notice_form.js?ver=0"></script>
    <title>공지사항</title>
  </head>
  <body>
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
          <td><input type="text" style="font-size:15px; width:100px;"></td>
        </tr>
        <tr style="height:400px;">
          <th>내용</th>
          <td><textarea name="content" id="summernote"></textarea></td>
        </tr>
        <tr>
          <th>파일</th>
          <td style="text-align:center;"> <input type="file" name="" value=""> </td>
        </tr>
      </table>
        <div class="admin">
          <button id="admin_write_btn" type="button" name="button">완료</button>
          <button id="admin_write_btn" type="button" name="button">목록</button>
        </div>

    </section>
    <br><br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
