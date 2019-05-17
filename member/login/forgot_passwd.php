<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>로그인</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/css/login.css">
  </head>
  <body>
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
        <tr><td colspan="3"><input type="checkbox" name="id_storage">아이디저장&nbsp;&nbsp;<a href="#">회원가입</a></td></tr>
        <tr><td colspan="3"><a href="#">Forgot ID</a>&nbsp; / &nbsp;<a href="#">Password?</a></td></tr>
        <tr>
          <td colspan="3">
            <a href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/naver.png" alt="네이버계정로그인"></a>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
