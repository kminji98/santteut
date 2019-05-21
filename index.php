<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/create_table.php";
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=0.1">
    <title>산뜻 :: 즐거운 산행</title>
  </head>

  <body>
    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>

    <!--검색(국가명/도시명/산이름)-->
    <div id="main_search">
      <br><br><br><br><br><br><br><br><br>
      <div id="search1">
      <input type="text" id="tex1" name="search" size="30" placeholder="국가명 / 도시명 / 산 이름으로 검색">
      <button type="button" name="button">검색</button>
      </div>
    </div>
<br>
<br>
<br>
    <!--인기 산행 일정 TOP3-->
    <div id="main_big3">
      <h1>인기 산행 일정 TOP3</h1>
      <div id="best3">
        <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/best3.php";?>
      </div>
    </div>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>

    </div>

  </body>
</html>
