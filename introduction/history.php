<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <title>소개</title>
  </head>
  <body>
    <!--로그인 회원가입 로그아웃-->
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>

    <section id="history">
      <h2>산뜻소개</h2>
      <hr>
      <ul id="title_history">
          연혁
      </ul>
<hr>
<div class="fieldset">

      <fieldset>
        <legend><h3>산뜻산악회</h3></legend>
        <ul>
          <li><b>2019년</b> <strong>5월 7일</strong> 산뜻산악회 창립</li>
          <li><b>2020년</b> <strong>5월 8일</strong> 김주오이조민</li>
          <li><b>2021년</b> <strong>5월 9일</strong> 짱짱걸맨들</li>
        </ul>
      </fieldset>
    </div>
    </section>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
