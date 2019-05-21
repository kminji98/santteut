<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/css/forgot_id.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <title>아이디찾기</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <section id="login">
    <h2>로그인</h2>
    <div class="login_form">
      <br>
      <br>
      <br>
      <br>
      <br>
      <h3>아이디찾기</h3>
      <table>
        <tr>
          <th>&nbsp;<a href="#">이메일로 찾기</a>&nbsp;</th>
          <th><a href="#">핸드폰으로 찾기</a></th>

        </tr>

        <tr>
          <th style="height:1%;">이메일</th>
          <td>
            <input type="text" name="" value="" size="7"> @
            <input type="text" name="" value="" size="7">
            <button type="button" name="button" style="font-size: 13px;">인증하기</button>
          </td>

        </tr>
        <tr>
          <td colspan="2">본인확인 이메일 주소와 입력한 이메일 주소가 같아야,<br>
            인증번호를 받을 수 있습니다.</td>
        </tr>
      </table>
    </div>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
