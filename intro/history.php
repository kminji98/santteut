<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../common/css/login_menu.css">
    <link rel="stylesheet" href="../common/css/history.css">
    <title>소개</title>
  </head>

  <body>
    <!--로그인 회원가입 로그아웃-->
    <header>
      <?php include "../common/lib/login_menu2.php"; ?>
    </header>

    <!--국내산행 해외산행-->
    <nav>
      <?php include "../common/lib/nav_menu2.php"; ?>
    </nav>

    <section id="history">
      <h2>소개</h2>

      <ul id="title_history">
        <li>연혁</li>
      </ul>

      <fieldset>
        <legend><h3>산뜻산악회</h3></legend>
        <ul>
          <li><b>2019년</b> <strong>5월 7일</strong> 산뜻산악회 창립</li>
          <li><b>2020년</b> <strong>5월 8일</strong> 김주오이조</li>
          <li><b>2021년</b> <strong>5월 9일</strong> 짱짱걸맨들</li>
        </ul>
      </fieldset>
    </section>
    <br>

    <footer>
      <?php include "../common/lib/footer.php"; ?>
    </footer>
  </body>
</html>
