<!-- =================================================================
// + [DESC] history 총괄
// + [DATE] 2019-05-26
// + [NAME] 이우주
// ================================================================= -->

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
      <h2 style="margin-left: 18%;">산뜻소개</h2>
      <hr>
      <ul id="title_history">
          연혁
      </ul>
      <hr>
      <h4>산뜻산악회</h4>
        <ul id="field">
          <li><b>2019년</b> <strong>6월 20일</strong><br><br>
            미래교육원수료와 함께 첫번째로 설립된 민간조직<br><br>
            김주오이조민회원들을 중심으로 미래강당에서 창립총회를 갖고 명칭을 산뜻산악회라 칭함<br><br>
            초대 팀장에 php파이어 김밍밍 언니를 추대<br><br>
            산뜻산악회는 첫 사업으로 5명의 동지들이 모여 미래교육원수료기념등산회를 가짐<br><br>
          </li>
          <br>
          <li><b>2019년</b> <strong>6월 21일</strong><br><br>
            등산의 일상화를 위해 미래교육원생들을 대상으로 제 1회 등행대회를 개최<br><br>
        </ul>

    </div>
    </section>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
