<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/css/login.css">
    <title>로그인</title>
  </head>
  <body>
    <!--로그인 회원가입 로그아웃-->
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <section id="login">
    <h2>로그인</h2>
    <hr>
    <div class="login_form">
      <h3>로그인</h3>
      <table>
        <tr>
          <th><label>아이디</label></th>
          <td><input type="text" name="login_id"></td>
          <th rowspan="2"><button type="button" name="button" id="login_button">로그인</button> </th>
        </tr>
        <tr>
          <th><label>비밀번호</label> </th>
          <td><input type="password" name="login_passwd"></td>
        </tr>
        <tr>
          <td id="empty_row" colspan="3"><br></td>
        </tr>
        <tr><td id="id_storage" colspan="3"><input type="checkbox" name="id_storage">아이디저장&nbsp;&nbsp;<a href="#"><b>회원가입</b></a></td></tr>
        <tr>
          <td id="empty_row" colspan="3"><br></td>
        </tr>
        <tr><td colspan="3">&nbsp;&nbsp;<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/forgot_id.php">아이디 찾기</a>&nbsp; / &nbsp;<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/forgot_passwd.php">패스워드 찾기</a></td></tr>
        <tr>
          <td id="empty_row" colspan="3"><br></td>
        </tr>
        <tr>
          <td colspan="3">
            <a href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/naver.jpg" alt="네이버계정로그인"></a>
            <a href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/facebook.jpg" alt="페이스북계정로그인"></a><br>
            <a href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/kakao.jpg" alt="카카오계정로그인"></a>
            <a href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/google.jpg" alt="구글계정로그인"></a>
          </td>
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
