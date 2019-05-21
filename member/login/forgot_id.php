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
    <hr>
    <div class="login_form">
      <h3>아이디찾기</h3>
      <table border="1">
        <tr>
          <th>&nbsp;<a href="#">아이디로 찾기</a>&nbsp;</th>
          <th><a href="#">핸드폰으로 찾기</a></th>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <th>이메일</th>
          <td>
            <input type="email" name="" value="">
            <button type="button" name="button">보내기</button>
          </td>
        </tr>
        <!--문구수정요망-->
        <tr>
          <td colspan="2"><br>이메일로 아이디를 가르켜드립니다.<br><br></td>
        </tr>
      </table>
    </div>
    </section>
  <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
